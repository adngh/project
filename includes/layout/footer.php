<div id="footer">All Copyrights Reserved for FCIT</div>

</body>
</html>

<?php
// Db close automatically, but it is a good practice to close it
// but first we check, does the file that included the footer has a DB connection
 if(isset($connection)){
mysqli_close($connection);
}
?>