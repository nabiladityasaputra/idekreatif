<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Memasukkan header halaman
include '.includes/header.php';

// Mengambil ID postingan yang akan diedit dari parameter URL
$postIdToEdit = $_GET['post_id']; // Pastikan parameter 'post_id' ada di URL

// Query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM posts WHERE id_post = $postIdToEdit";
$result = $conn->query($query);

// Memeriksa apakah data postingan ditemukan
if ($result->num_rows > 0) {
    $post = $result->fetch_assoc(); // Mengambil data postingan ke dalam array
} else {
    // Menampilkan pesan jika postingan tidak ditemukan
    echo "Post not found.";
    exit(); // Menghentikan eksekusi jika tidak ada postingan
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4>Halaman Edit Postingan</h4>
    <div class="card card-md">
        <div class="card-body">
            <!-- Form untuk mengupdate postingan -->
            <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo $postIdToEdit; ?>">

                <!-- Input untuk judul postingan -->
                <div class="mb-3">
                    <label for="post_title" class="form-label">Judul Postingan</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post['post_title']; ?>" required>
                </div>

                <!-- Input untuk unggah gambar -->
                <div class="mb-3">
                    <label for="image_path" class="form-label">Unggah Gambar</label>
                    <input class="form-control" type="file" id="image_path" name="image_path">
                    <p>Gambar saat ini:</p>
                    <img src="<?php echo $post['image_path']; ?>" alt="Current Image" style="max-width: 200px;">
                </div>

                <!-- Dropdown untuk kategori -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <?php
                        $queryCategories = "SELECT * FROM categories";
                        $resultCategories = $conn->query($queryCategories);

                        if ($resultCategories->num_rows > 0) {
                            while ($row = $resultCategories->fetch_assoc()) {
                                $selected = ($row['category_id'] == $post['category_id']) ? "selected" : "";
                                echo "<option value='" . $row['category_id'] . "' $selected>" . $row['category_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Textarea untuk konten postingan -->
                <div class="mb-3">
                    <label for="content" class="form-label">Konten</label>
                    <textarea class="form-control" id="content" name="content" required><?php echo $post['content']; ?></textarea>
                </div>

                <!-- Tombol untuk memperbarui postingan -->
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<?php include '.includes/footer.php';
?>
