<?php
// logout.php - Logout handling
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>      
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>