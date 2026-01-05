document.querySelectorAll('.details-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        let courseId = this.closest('.course-box').dataset.id;
        fetch(`controllers/courseController.php?action=courseDetails&id=${courseId}`)
            .then(res => res.text())
            .then(data => {
                document.getElementById('popup-body').innerHTML = data;
                document.getElementById('course-popup').style.display = 'flex';
            });
    });
});

// Close popup
document.querySelector('.popup .close').addEventListener('click', function(){
    document.getElementById('course-popup').style.display = 'none';
});

// Close popup if click outside content
document.getElementById('course-popup').addEventListener('click', function(e){
    if(e.target === this){
        this.style.display = 'none';
    }
});
