
<?php
function getAlumnosWithAttendanceCount($start, $end)
{
    $query = "select alumnos.name, 
sum(case when status = 'presence' then 1 else 0 end) as presence_count,
sum(case when status = 'absence' then 1 else 0 end) as absence_count 
 from alumno_attendance
 inner join alumnos on alumnos.id = alumno_attendance.alumno_id
 where date >= ? and date <= ?
 group by alumno_id;";
    $db = getDatabase();
    $statement = $db->prepare($query);
    $statement->execute([$start, $end]);
    return $statement->fetchAll();
}

function saveAttendanceData($date, $alumnos)
{
    deleteAttendanceDataByDate($date);
    $db = getDatabase();
    $db->beginTransaction();
    $statement = $db->prepare("INSERT INTO alumno_attendance(alumno_id, date, status) VALUES (?, ?, ?)");
    foreach ($alumnos as $alumno) {
        $statement->execute([$alumno->id, $date, $alumno->status]);
    }
    $db->commit();
    return true;
}

function deleteAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM alumno_attendance WHERE date = ?");
    return $statement->execute([$date]);
}
function getAttendanceDataByDate($date)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT alumno_id, status FROM alumno_attendance WHERE date = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}


function deleteAlumno($id)
{
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM alumnos WHERE id = ?");
    return $statement->execute([$id]);
}

function updateAlumno($name, $id)
{
    $db = getDatabase();
    $statement = $db->prepare("UPDATE alumnos SET name = ? WHERE id = ?");
    return $statement->execute([$name, $id]);
}
function getAlumnoById($id)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT id, name FROM alumnos WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetchObject();
}

function saveAlumno($name)
{
    $db = getDatabase();
    $statement = $db->prepare("INSERT INTO alumnos(name) VALUES (?)");
    return $statement->execute([$name]);
}

function getAlumnos()
{
    $db = getDatabase();
    $statement = $db->query("SELECT id, name FROM alumnos");
    return $statement->fetchAll();
}

function getVarFromEnvironmentVariables($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("The environment file ($file) does not exists. Please create it");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("The specified key (" . $key . ") does not exist in the environment file");
    }
}

function getDatabase()
{
    $password = getVarFromEnvironmentVariables("MYSQL_PASSWORD");
    $user = getVarFromEnvironmentVariables("MYSQL_USER");
    $dbName = getVarFromEnvironmentVariables("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
