<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course Information System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/icons/favicon.ico">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center mb-4">Course Information System</h1>
        <div class="row container-fluid py-2">
            <!-- Add New  -->
            <div class="col-12 col-lg-4 form-container py-3">
                    <h3 id="frm-caption">Add New Course</h3>
                    <form method="POST" id="frm-info">
                        <div class="my-3">
                            <label for="course-name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="course-name" placeholder="Enter course name" required>
                        </div>
                        <div class="mb-3">
                            <label for="schedule-days" class="form-label">Schedule Day</label>
                            <select class="form-select" id="schedule-days" required>
                                <option value="">Select Schedule Day</option>
                                <option value="Mon-Fri">Monday-Friday</option>
                                <option value="Mon-Sat">Monday-Saturday</option>
                                <option value="Sat-Sun">Saturday-Sunday</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start-time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="start-time" placeholder="Enter course start time" required>
                        </div>
                        <div class="mb-3">
                            <label for="end-time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="end-time" placeholder="Enter course end time" required>
                        </div>
                        <div class="mb-3">
                            <label for="start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start-date" placeholder="Enter start date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" placeholder="Enter end date">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Course Description</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="Enter course description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Course</button>
                    </form>
            </div>
            <!-- View, Edit, Delete  -->
            <div class="col-12 col-lg-8 show-table py-3">
                    <div class="row">
                        <div class="col-12 col-lg-7 mb-4">
                            <h3>Course List</h3>
                        </div>
                        <div class="col-12 col-lg-5 mb-4">
                            <form method="POST" id="frm-search">
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="search-course-name" placeholder="Search By Course Name" required> 
                                    <button type="submit" class="btn btn-secondary">Search</button>
                                </div>
                            </form>
                        </div>
                        <!-- Modal  -->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Schedule Days</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-course">
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/script.js"></script>
</body>
</html>