document.getElementById('tapButton').addEventListener('click', function() {
    fetch('update_counter.php', {
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('count').innerText = data;
    });
});
