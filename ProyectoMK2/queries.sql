select * from alumno_attendance order by alumno_id;
# Get alumnos with absence and presence count in date range 
select alumnos.name, 
sum(case when status = 'presence' then 1 else 0 end) as presence_count,
sum(case when status = 'absence' then 1 else 0 end) as absence_count 
 from alumno_attendance
 inner join alumnos on alumnos.id = alumno_attendance.alumno_id
 where date >= '2020-11-01' and date <= '2020-11-16'
 group by alumno_id;