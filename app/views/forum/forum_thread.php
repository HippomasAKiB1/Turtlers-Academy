<!DOCTYPE html>
<html>

<head>
    <title><?= htmlspecialchars($thread['title']) ?></title>
    <link rel="stylesheet" href="assets/css/forum_style.css">
</head>

<body>

    <div class="container">
        <h2><?= htmlspecialchars($thread['title']) ?></h2>
        <p><?= nl2br(htmlspecialchars($thread['description'])) ?></p>
        <small>Posted by <?= $thread['fullname'] ?> | <?= $thread['created_at'] ?></small>

        <hr>

        <h3>Discussion</h3>

        <?php while ($c = mysqli_fetch_assoc($comments)) { ?>
            <div class="comment">
                <strong><?= $c['fullname'] ?></strong>
                <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                <small><?= $c['created_at'] ?></small>
            </div>
        <?php } ?>

        <form id="commentForm" method="POST" action="forum.php?action=comment">
            <input type="hidden" name="thread_id" value="<?= $thread['id'] ?>">
            <textarea name="comment" placeholder="Write your reply..." required></textarea>
            <button class="btn">Reply</button>
        </form>
    </div>

    <script>
        document.getElementById('commentForm').addEventListener('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('ajax', 1);

            fetch('forum.php?action=comment', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        
                        let div = document.createElement('div');
                        div.className = 'comment';
                        div.style.backgroundColor = '#e8fdf5'; 
                        div.innerHTML = `
                <strong>${data.user}</strong>
                <p>${data.comment.replace(/\n/g, '<br>')}</p>
                <small>${data.date}</small>
            `;
                        
                        let form = document.getElementById('commentForm');
                        form.parentNode.insertBefore(div, form);

                        
                        form.querySelector('textarea').value = '';
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(err => console.error(err));
        });
    </script>
    </div>

</body>

</html>