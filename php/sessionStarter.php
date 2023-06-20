<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <title>Session Expiration Popup</title>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            background: #fad7b1;
            /* opacity: 0.1; */
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            opacity: 1;
            /* z-index: 2; */
        }

        .modal-header h4 {
            margin-top: 0;
        }

        .modal-footer {
            text-align: right;
        }
        .modal-footer > button{
            font-weight: 200px;
            text-decoration: none;
            width: 7vw;
            border-radius: 10px;
            height: 29px;
            background-color: beige;
            /* color: ; */
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php
            // PHP code to check if the session has expired or not set
            // session_destroy();
            if (!isset($_SESSION['uid'])) {
                // Session expired or not set, display the popup and redirect to the login page
                echo '$(window).on("load", function() {';
                echo '    $("#sessionExpiredModal").show();';
                echo '});';
            }
            ?>
        });
    </script>
</head>
<body>
    <!-- Session Expiration Popup Modal -->
    <div id="sessionExpiredModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Session Expired</h4>
            </div>
            <div class="modal-body">
                <p>Your haven't logged in or your session has expired. Please log in again to continue.</p>
            </div>
            <div class="modal-footer">
            <button onclick="window.location='login-front.php'">Login</button>
            </div>
        </div>
    </div>
</body>
</html>
