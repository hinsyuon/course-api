(()=>{
    const frmCourse = document.getElementById('frm-info');
    const iCourseName = document.getElementById('course-name');
    const iScheduleDays = document.getElementById('schedule-days');
    const iStartTime = document.getElementById('start-time');
    const iEndTime = document.getElementById('end-time');
    const iStartDate = document.getElementById('start-date');
    const iEndDate = document.getElementById('end-date');
    const iDescription = document.getElementById('description');
    const tblCourse = document.getElementById('table-course');
    const frmSearchCourseName = document.getElementById('frm-search');
    const iSearchCourseName = document.getElementById('search-course-name');
    const btnSubmit = document.getElementById('submit');
    const frmCaption = document.getElementById('frm-caption');
    let selectedID = 0;

    const loadData = () => {
        tblCourse.innerHTML = '';
        axios.get(`/api/courses/index.php?search=${iSearchCourseName.value}`).then(res => {
            res.data.courses.forEach(item =>  {
                tblCourse.innerHTML += `
                    <tr>
                        <td class="align-middle">${item.course_name}</td>
                        <td class="align-middle">${item.schedule_days}</td>
                        <td class="align-middle">${item.start_time}</td>
                        <td class="align-middle">${item.end_time}</td>
                        <td class="align-middle">${item.start_date}</td>
                        <td class="align-middle">${item.end_date}</td>
                        <td class="align-middle">${item.description}</td>
                        <td class="align-middle">
                            <div class="d-flex gap-3">
                                <a data-course='${JSON.stringify(item)}' role="button" class="btn btn-warning btn-edit">Edit</a>
                                <a data-id="${item.id}" role="button" class="btn btn-danger btn-delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                `;
            })
            // Update
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.onclick = (e) => {
                    frmCaption.innerHTML = 'Edit Course Info';
                    btnSubmit.innerHTML = 'Save';
                    const selectedCourseJSON = btn.getAttribute('data-course');
                    const course = JSON.parse(selectedCourseJSON);
                    selectedID = course.id;
                    iCourseName.value = course.course_name;
                    iScheduleDays.value = course.schedule_days;
                    iStartTime.value = course.start_time;
                    iEndTime.value = course.end_time;
                    iStartDate.value = course.start_date;
                    iEndDate.value = course.end_date;
                    iDescription.value = course.description;
                }
            })
            // Delete 
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.onclick = (e) => {
                    if(confirm("Do you really want to delete this Course?") == true) { 
                        selectedID = btn.getAttribute('data-id');
                        axios.get(`/api/courses/destroy.php?id=${selectedID}`).then(res => {
                            if(!res.data.result) {
                                return;
                            }
                            selectedID = 0;
                            loadData();
                        })
                    } 
                }
            })
        })
    }

    // Search By Course Name
    frmSearchCourseName.onsubmit = (e) => {
        e.preventDefault();
        
        let frmData = new FormData();
        frmData.append('search-by-course-name', iSearchCourseName.value);
        loadData();
        iSearchCourseName.value = '';
        iSearchCourseName.focus();
    }

    frmCourse.onsubmit = (e) => {
        e.preventDefault();

        let frmData = new FormData();
        frmData.append('course_name', iCourseName.value);
        frmData.append('schedule_days', iScheduleDays.value);
        frmData.append('start_time', iStartTime.value);
        frmData.append('end_time', iEndTime.value);
        frmData.append('start_date', iStartDate.value);
        frmData.append('end_date', iEndDate.value);
        frmData.append('description', iDescription.value);

        if(selectedID > 0) {
            frmData.append('id', selectedID);
        }
        if(selectedID == 0) {
            axios.post(`/api/courses/store.php`, frmData).then(res =>{
                if(!res.data.result) {
                    return;
                }
                iCourseName.value = iScheduleDays.value = iStartTime.value = iEndTime.value = iStartDate.value = iEndDate.value = iDescription.value = '';
                iCourseName.focus();
                loadData();
        })  
       } else{
            axios.post(`/api/courses/update.php?id=${selectedID}`, frmData).then(res => {
                if(!res.data.result) {
                    return;
                }
                frmCaption.innerHTML = 'Add New Course';
                btnSubmit.innerHTML = 'Add Course';
                iCourseName.value = iScheduleDays.value = iStartTime.value = iEndTime.value = iStartDate.value = iEndDate.value = iDescription.value = '';
                iCourseName.focus();
                loadData();
            })
       }
    }

    // Initial load
    loadData();
})()