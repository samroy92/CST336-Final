<?php
require 'db_connection.php';

	$error = "";
	$result = "";
	
	
    function getFemaleStudents() {
    global $dbConn;
    $sql = "SELECT firstName, lastName
            FROM m_students
            WHERE gender like 'F'
            ORDER BY lastName ASC";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
    }
	
	function getGradeLowerThan() {
	global $dbConn;
    $sql = "SELECT m_students.firstName, m_students.lastName, m_gradebook.grade
            FROM m_students, m_assignments, m_gradebook
            WHERE m_students.studentId = m_gradebook.studentId
            AND m_assignments.assignmentId = m_gradebook.assignmentId
            AND m_gradebook.grade < 50
            ORDER BY m_gradebook.grade ASC";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
	}
	
	function getUngradedAssignments() {
	global $dbConn;
    $sql = "SELECT m_assignments.title, m_assignments.dueDate
            FROM m_assignments
            WHERE m_assignments.assignmentId NOT IN (SELECT m_gradebook.assignmentId FROM m_gradebook)
            ORDER BY m_assignments.dueDate ASC";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
	}
	
	function getGradebook() {
	global $dbConn;
    $sql = "SELECT m_students.firstName, m_students.lastName, m_assignments.title, m_gradebook.grade
            FROM m_assignments, m_students, m_gradebook
            WHERE m_students.studentId = m_gradebook.studentId
            AND m_assignments.assignmentId = m_gradebook.assignmentId
            ORDER BY m_students.lastname,m_assignments.title ASC";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
	}
	
	function getAverageGrade() {
	global $dbConn;
    $sql = "SELECT m_students.studentId, m_students.firstName, m_students.lastName, AVG(m_gradebook.grade)
            FROM m_students, m_assignments, m_gradebook
            WHERE m_students.studentId = m_gradebook.studentId
            GROUP BY m_students.studentId
            ORDER BY AVG(m_gradebook.grade) DESC";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
	}
?>

<p>
	<h3>getFemaleStudents():</h3>
</p>
<ol>
 <?php foreach(getFemaleStudents() as $student): ?>
 	
             <li><? echo $student['firstName'] ?> | 
             	<? echo $student['lastName'] ?> | 
             </li> 
            <?php endforeach; ?>
</ol>

<p>
	<h3>getGradeLowerThan():</h3>
</p>
<ol>
 <?php foreach(getGradeLowerThan() as $student): ?>
 	
             <li><? echo $student['firstName'] ?> | 
             	<? echo $student['lastName'] ?> | 
             	<? echo $student['grade'] ?> | 
             </li> 
            <?php endforeach; ?>
</ol>

<p>
	<h3>getUngradedAssignments():</h3>
</p>
<ol>
 <?php foreach(getUngradedAssignments() as $assignment): ?>
 	
             <li><? echo $assignment['title'] ?> | 
             	<? echo $assignment['dueDate'] ?>
             </li> 
            <?php endforeach; ?>
</ol>

<p>
	<h3>getGradebook():</h3>
</p>
<ol>
 <?php foreach(getGradebook() as $assignment): ?>
 	
             <li>
             	<? echo $assignment['firstName'] ?> | 
             	<? echo $assignment['lastName'] ?> | 
             	<? echo $assignment['title'] ?> | 
             	<? echo $assignment['grade'] ?>
             </li> 
            <?php endforeach; ?>
</ol>

<p>
	<h3>getAverageGrade():</h3>
</p>
<ol>
 <?php foreach(getAverageGrade() as $grade): ?>
 	
             <li>
             	<? echo $grade['studentId'] ?> | 
             	<? echo $grade['firstName'] ?> | 
             	<? echo $grade['lastName'] ?> | 
             	<? echo $grade['AVG(m_gradebook.grade)'] ?>
             </li> 
            <?php endforeach; ?>
</ol>