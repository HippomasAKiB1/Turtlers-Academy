document.querySelectorAll('.details-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        let courseId = this.closest('.course-box').dataset.id;
        fetch("/repo/Turtlers-Academy/app/controllers/courseController.php?action=courseDetails&id=" + courseId)
            .then(res => res.text())
            .then(data => {
                document.getElementById('popup-body').innerHTML = data;
                document.getElementById('course-popup').style.display = 'flex';
            });
    });
});


document.querySelector('.popup .close').addEventListener('click', function(){
    document.getElementById('course-popup').style.display = 'none';
});


document.getElementById('course-popup').addEventListener('click', function(e){
    if(e.target === this){
        this.style.display = 'none';
    }
});
