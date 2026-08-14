// Menangani pengiriman pesan
document.addEventListener("DOMContentLoaded", () => {
    const messageForm = document.getElementById("messageForm");
    const messageBox = document.getElementById("messages");

    if (messageForm) {
        messageForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const formData = new FormData(messageForm);

            // Mengirim pesan menggunakan AJAX
            fetch('send_message.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Log pesan dari server
                    messageForm.reset(); // Mengosongkan form
                    fetchMessages(); // Memperbarui pesan
                })
                .catch(error => console.error('Error:', error));
        });
    }

    // Fungsi untuk mengambil pesan terbaru
    function fetchMessages() {
        fetch('fetch_messages.php')
            .then(response => response.text())
            .then(data => {
                messageBox.innerHTML = data; // Menampilkan pesan
                messageBox.scrollTop = messageBox.scrollHeight; // Scroll ke bawah
            })
            .catch(error => console.error('Error:', error));
    }

    // Memperbarui pesan setiap 3 detik
    if (messageBox) {
        setInterval(fetchMessages, 3000);
    }

    // Notifikasi pesan baru
    function checkNewMessages() {
        fetch('check_notifications.php')
            .then(response => response.json())
            .then(data => {
                if (data.newMessages) {
                    alert("Pesan baru diterima!");
                }
            })
            .catch(error => console.error('Error:', error));
    }

    setInterval(checkNewMessages, 5000); // Memeriksa notifikasi setiap 5 detik
});

// Menangani unggahan file
const uploadForm = document.getElementById("uploadFileForm");
if (uploadForm) {
    uploadForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(uploadForm);

        // Mengunggah file menggunakan AJAX
        fetch('upload_file.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data); // Menampilkan respons dari server
                uploadForm.reset(); // Mengosongkan form
            })
            .catch(error => console.error('Error:', error));
    });
}
