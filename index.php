<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STUDENT INFORMATION</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{background:#f3f7fa}
.card-header h1{letter-spacing:2px}

/* for DASHBOARD design */
.dashboard-wrapper{max-width:1000px;margin:10px auto}
.dashboard-card{border-radius:10px;box-shadow:0 1px 5px rgba(0,0,0,.1)}
.dashboard-card .card-body{padding:12px}
.dashboard-card h6{font-size:13px;margin-bottom:6px;font-weight:600}
.dashboard-card .btn{width:100%;font-size:13px;padding:6px 0}

/* for SEARCH design*/
#searchInput{border:2px solid #0d6efd;border-radius:20px;padding:8px}
#columnSelect{border-radius:12px}

/* for TABLE design*/
.table-wrapper{max-width:1000px;margin:auto}
table{background:#fff;border-radius:12px;overflow:hidden}
thead{background:#0d6efd;color:#fff;font-size:12px}
td,th{white-space:nowrap;font-size:13px;padding:8px;text-align:center}
.action-btns .btn{font-size:12px;padding:4px 6px}

/* STYLES FOR COURSE/MAJOR BUTTONS */
.course-filter-group {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 10px;
}
.course-filter-group .btn-sm {
    padding: 5px 10px;
    font-size: 13px;
    white-space: nowrap;
}
</style>
</head>

<body>

<div class="container-fluid">

<div class="card mt-1 mb-2">
    <div class="card-header text-center text-white" style="background:#0d6efd">
        <h1>STUDENT INFORMATION</h1>
        <h5><i>James Harold Van Ramos and others GROUP 6</i></h5>
    </div>
</div>

<div class="dashboard-wrapper">
<div class="row g-2">
    <div class="col-md-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <h6>Student</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Student</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <h6>Database</h6>
                <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-primary">Open Database</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <h6>Account</h6>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
</div>

<div class="table-wrapper">
    <div class="row mb-2 align-items-center">
        <div class="col-md-4">
            <div class="course-filter-group">
                <button class="btn btn-sm btn-dark filter-course" data-course-filter="BSIS">BSIS</button>
                <button class="btn btn-sm btn-dark filter-course" data-course-filter="ACT">ACT</button>
                <button class="btn btn-sm btn-dark filter-course" data-course-filter="BEED">BEED</button>
                <button class="btn btn-sm btn-primary filter-course" data-course-filter="BSED">BSED</button>
                <button class="btn btn-sm btn-info filter-course" data-course-filter="ENGINEER TECH">ENG TECH</button>
                <button class="btn btn-sm btn-secondary filter-course" data-course-filter="all">Show All</button>
            </div>
        </div>
        <div class="col-md-8">
            <div id="bsed-majors" class="course-filter-group d-none" data-course-container="BSED">
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="English">English</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="Filipino">Filipino</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="Science">Science</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="Math">Math</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="Values">Values</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="Social Studies">Social Studies</button>
                <button class="btn btn-sm btn-outline-primary filter-major" data-course="BSED" data-major-filter="PE">PE</button>
            </div>
            <div id="eng-tech-majors" class="course-filter-group d-none" data-course-container="ENGINEER TECH">
                <button class="btn btn-sm btn-outline-info filter-major" data-course="ENGINEER TECH" data-major-filter="Electronics">Electronics</button>
                <button class="btn btn-sm btn-outline-info filter-major" data-course="ENGINEER TECH" data-major-filter="Automotive">Automotive</button>
            </div>
        </div>
    </div>
</div>

<div class="table-wrapper">
<div class="row mb-2">
    <div class="col-4">
        <select id="columnSelect" class="form-select">
            <option value="all">Search All</option>
            <option value="0">First Name</option>
            <option value="1">Last Name</option>
            <option value="2">Age</option>
            <option value="3">Sex</option>
            <option value="4">Section</option>
            <option value="5">Course</option>
            <option value="6">Year Level</option>
            <option value="7">Major</option>
        </select>
    </div>
    <div class="col-8">
        <input id="searchInput" class="form-control" placeholder="Search student">
    </div>
</div>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th>First</th><th>Last</th><th>Age</th><th>Sex</th><th>Section</th>
<th>Course</th><th>Year</th><th>Major</th><th>Action</th>
</tr>
</thead>
<tbody>
<?php
include 'conn.php';
$q="SELECT id,firstname,lastname,age,sex,section,course,yearlevel,major FROM student";
$stmt=$conn->prepare($q);
$stmt->execute();
$stmt->bind_result($id,$fn,$ln,$age,$sex,$sec,$course,$yl,$major);
while($stmt->fetch()){
?>
<tr>
<td><?= $fn ?></td>
<td><?= $ln ?></td>
<td><?= $age ?></td>
<td><?= $sex ?></td>
<td><?= $sec ?></td>
<td data-col="5"><?= $course ?></td>
<td data-col="6"><?= $yl ?></td>
<td data-col="7"><?= $major ?></td>
<td class="action-btns">
<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $id ?>">Edit</button>
<a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>

<div class="modal fade" id="edit<?= $id ?>" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<form action="update.php" method="post" onsubmit="return confirm('Confirm saving changes for <?= $fn ?> <?= $ln ?>?');">
<div class="modal-header">
<h5>Edit Student</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input type="hidden" name="id" value="<?= $id ?>">
<input class="form-control mb-2" name="firstname" value="<?= $fn ?>" placeholder="First Name">
<input class="form-control mb-2" name="lastname" value="<?= $ln ?>" placeholder="Last Name">
<input class="form-control mb-2" name="age" value="<?= $age ?>" placeholder="Age">
<input class="form-control mb-2" name="sex" value="<?= $sex ?>" placeholder="Sex">
<input class="form-control mb-2" name="section" value="<?= $sec ?>" placeholder="Section">
<input class="form-control mb-2" name="course" value="<?= $course ?>" placeholder="Course">
<input class="form-control mb-2" name="yearlevel" value="<?= $yl ?>" placeholder="Year Level">
<input class="form-control mb-2" name="major" value="<?= $major ?>" placeholder="Major">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button> 
</div>
</form>
</div>
</div>
</div>
<?php } // Loops end here (END of WHILE loop) ?>
</tbody>
</table>
</div>
</div>
</div>

<div class="modal fade" id="add" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<form action="insert.php" method="post">
<div class="modal-header">
<h5>Add Student</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input class="form-control mb-2" name="firstname" placeholder="First Name">
<input class="form-control mb-2" name="lastname" placeholder="Last Name">
<input class="form-control mb-2" name="age" placeholder="Age">
<input class="form-control mb-2" name="sex" placeholder="Sex">
<input class="form-control mb-2" name="section" placeholder="Section">
<input class="form-control mb-2" name="course" placeholder="Course">
<input class="form-control mb-2" name="yearlevel" placeholder="Year Level">
<input class="form-control mb-2" name="major" placeholder="Major">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Add</button>
</div>
</form>
</div>
</div>
</div>

<script>
const searchInput=document.getElementById("searchInput");
const columnSelect=document.getElementById("columnSelect");
const rows=document.querySelectorAll("tbody tr");

// --- FILTER ELEMENTS ---
const courseButtons = document.querySelectorAll(".filter-course");
const majorContainers = document.querySelectorAll('[data-course-container]');
const majorButtons = document.querySelectorAll(".filter-major");

let activeCourseFilter = 'all'; 
let activeMajorFilter = ''; 


const allModals = document.querySelectorAll('.modal.fade'); 


function filterTable(){
    const searchValue = searchInput.value.toLowerCase();
    const searchColumnIndex = columnSelect.value;

    rows.forEach(row => {
        let textToSearch = "";
        let passesSearch = false;
        let passesCourseFilter = true;

        const courseCell = row.querySelector('td[data-col="5"]');
        if (activeCourseFilter !== 'all' && courseCell) {
            const rowCourse = courseCell.textContent.trim().toUpperCase();
            
            if (rowCourse !== activeCourseFilter.toUpperCase()) {
                passesCourseFilter = false;
            } else if (activeMajorFilter !== '') {
                const majorCell = row.querySelector('td[data-col="7"]');
                const rowMajor = majorCell ? majorCell.textContent.trim().toUpperCase() : '';
                
                if (rowMajor !== activeMajorFilter.toUpperCase()) {
                    passesCourseFilter = false; 
                }
            }
        }
        
        if (passesCourseFilter) {
            if (searchColumnIndex === "all") {
                textToSearch = row.innerText;
            } else {
                const cell = row.children[searchColumnIndex];
                textToSearch = cell ? cell.innerText : '';
            }
            
            passesSearch = textToSearch.toLowerCase().includes(searchValue);
        }

        row.style.display = passesCourseFilter && passesSearch ? "" : "none";
    });
}


allModals.forEach(modal => {
    modal.addEventListener('hidden.bs.modal', function () {
        const form = modal.querySelector('form');
        if (form) {
            form.reset();
        }
    });
});




searchInput.addEventListener("keyup", filterTable);
columnSelect.addEventListener("change", filterTable);

// Course Filter Buttons naman para sa primary filter
courseButtons.forEach(button => {
    button.addEventListener('click', function() {
        const newCourseFilter = this.getAttribute('data-course-filter').toUpperCase();
        activeMajorFilter = ''; 
        
        if (activeCourseFilter === newCourseFilter) {
             activeCourseFilter = 'all';
        } else {
             activeCourseFilter = newCourseFilter;
        }

        majorContainers.forEach(container => {
            if (container.getAttribute('data-course-container').toUpperCase() === activeCourseFilter) {
                container.classList.remove('d-none');
            } else {
                container.classList.add('d-none');
            }
        });
        
        courseButtons.forEach(btn => btn.classList.remove('active'));
        if (activeCourseFilter !== 'all') {
             this.classList.add('active');
        }

        filterTable(); 
    });
});

// Major filter button kung baga siya nag-aapply ng secondary filter sa active course
majorButtons.forEach(button => {
    button.addEventListener('click', function() {
        const newMajorFilter = this.getAttribute('data-major-filter').toUpperCase();
        const requiredCourse = this.getAttribute('data-course').toUpperCase();

        activeCourseFilter = requiredCourse;
        
        if (activeMajorFilter === newMajorFilter) {
            activeMajorFilter = '';
        } else {
            activeMajorFilter = newMajorFilter;
        }

        majorButtons.forEach(btn => btn.classList.remove('active', 'btn-primary', 'btn-outline-primary', 'btn-info', 'btn-outline-info'));
        
        majorButtons.forEach(btn => {
             if (btn.getAttribute('data-course').toUpperCase() === 'BSED') {
                 btn.classList.add('btn-outline-primary');
             } else if (btn.getAttribute('data-course').toUpperCase() === 'ENGINEER TECH') {
                 btn.classList.add('btn-outline-info');
             }
        });
        
        if (activeMajorFilter !== '') {
            this.classList.remove('btn-outline-primary', 'btn-outline-info');
            this.classList.add(requiredCourse === 'BSED' ? 'btn-primary' : 'btn-info');
        }

        filterTable(); 
    });
});

document.addEventListener('DOMContentLoaded', filterTable);
</script>

</body>
</html>