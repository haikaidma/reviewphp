<?php
include_once 'connect.php';
$result = mysqli_query($con,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
h4{
	text-align: center;
}
.search{
	text-align: center;
}
</style>
<body>
	<h4>LIST USER</h4>
<div class="search" >
<form action="" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="submit" value="search" />
            </form>
			<?php
        include 'connect.php';
        if (isset($_REQUEST['submit'])) 
        {
            // Gán hàm addslashes để chống sql injection
            $search = addslashes(htmlspecialchars(mysqli_real_escape_string($con,$_GET['search'])));
            // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
            if (empty($search)) {
                echo "Please enter text";
            } 
            else
            {
                // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                
                $query = "select name,email from users where name like '%$search%' Or email like '%$search%'";
 
 
                // Thực thi câu truy vấn
                $sql = mysqli_query($con,$query);
 
                // Đếm số đong trả về trong sql.
                $num = mysqli_num_rows($sql);
 
                // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                if ($num > 0 && $search != "") 
                {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num results returned with the keyword <b>$search</b>";
 
                    // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
                    echo '<tr>';
                    echo "<td>Name</td>";
                    echo "<td>Email</td>";
                 
                echo '</tr>';
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '<tr>';
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['email']}</td>";
                         
                        echo '</tr>';
                    }
                    echo '</table>';
                } 
                else {
                    echo "Can't find results";
                }
            }
        }
        ?>   
</div>
<br>

<br>
<?php
				if(isset($_GET['alert'])){
				?> <p class="alert" style="color:green;"><?php echo $_GET['alert'];?></p>	
				<?php }
				?>
<?php 
        // PHẦN XỬ LÝ PHP
        // BƯỚC 1: KẾT NỐI CSDL
        include 'connect.php';

        // BƯỚC 2: TÌM TỔNG SỐ RECORDS
        $result = mysqli_query($con, 'select count(id) as total from users');
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total'];

        // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 4;

        // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
        // tổng số trang
        $total_page = ceil($total_records / $limit);

        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }

        // Tìm Start
        $start = ($current_page - 1) * $limit;

        // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
        // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
        $result = mysqli_query($con, "SELECT * FROM users LIMIT $start, $limit");
		// PHẦN HIỂN THỊ TIN TỨC
// BƯỚC 6: HIỂN THỊ DANH SÁCH TIN TỨC
		?>
	<table>
	<tr>
        <td>ID</td>
		<td>Name</td>
		<td>Email</td>
		<td>Action</td>
	</tr>
	<?php
	$i=0;
	while($row=mysqli_fetch_assoc($result)) {
	?>
	<tr>
        <td><?php echo $row["ID"]; ?></td>
		<td><?php echo $row["name"]; ?></td>
		<td><?php echo $row["email"]; ?></td>   
		<td class="td_delete"><a  class= "btn btn-danger" id="delete">Delete</a>
		<a href=" update.php?ID=<?php echo $row["ID"]; ?> " class="btn btn-success">Update</a>
	</td>
	</tr>
    <tbody id="table">
      
    </tbody>
	<?php
	$i++;
	}
	?>
</table>
 <div class="pagination">
           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG

            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="listuser.php?page='.($current_page-1).'">Prev</a> | ';
            }

            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="listuser.php?page='.$i.'">'.$i.'</a> | ';
                }
            }

            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="listuser.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
        </div>
		<br>
<a href='logout.php' class="btn btn-secondary">logout</a>
</body>
</html>	
<script>
    $(document).ready(function(){
        
        $('#delete').click(function(){
            var id = $(this).attr('ID');
            var confi = confirm('bạn có chắc muốn xóa user?');
            if(confi){
                $.ajax({
                method: "POST",
                url: 'delete.php',
                data:{
                    id_user: id,                               
                },
                success:function(data){
                    alert(data);

                }    

                });
            
                $(this).closest('td.td_delete').closest('tr').remove();
            }
            

        });


    })

</script>