<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabbed Tables</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: orange;
        }

        .tabs {
            display: flex;
            background-color: yellow;
            padding: 10px;
        }

        .tab-button {
            background-color: green;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        .tab-button:hover {
            background-color: pink;
        }

        .tab-button.active {
            background-color: #ccc;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border-top: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="tabs">
        <button class="tab-button" onclick="openTab(event, 'assignments')">Assignments</button>
        <button class="tab-button" onclick="openTab(event, 'attachments')">Attachments</button>
        <button class="tab-button" onclick="openTab(event, 'comments')">Comments</button>
        <button class="tab-button" onclick="openTab(event, 'tasks')">Tasks</button>
        <button class="tab-button" onclick="openTab(event, 'taskhistory')">Task History</button>
        <button class="tab-button" onclick="openTab(event, 'tags')">Tags</button>
        <button class="tab-button" onclick="openTab(event, 'notifications')">Notifications</button>
        <button class="tab-button" onclick="openTab(event, 'taskdependencies')">Task Dependencies</button>
        <button class="tab-button" onclick="openTab(event, 'projects')">Projects</button>
    </div>

    <div id="assignments" class="tab-content">
        <table>
            <tr>
                <th>Assignment ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>Assignment 1</td>
                <td>Complete the task</td>
                <td>2024-06-01</td>
            </tr>
        </table>
    </div>

    <div id="attachments" class="tab-content">
        <table>
            <tr>
                <th>Attachment ID</th>
                <th>File Name</th>
                <th>Upload Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>document.pdf</td>
                <td>2024-05-21</td>
            </tr>
        </table>
    </div>

    <div id="comments" class="tab-content">
        <table>
            <tr>
                <th>Comment ID</th>
                <th>User</th>
                <th>Comment</th>
                <th>Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>John Kabagema</td>
                <td>This is a comment.</td>
                <td>2024-05-21</td>
            </tr>
        </table>
    </div>

    <div id="tasks" class="tab-content">
        <table>
            <tr>
                <th>Task ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Assigned To</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>Task 1</td>
                <td>Open</td>
                <td>Jeanne Ufitimana</td>
            </tr>
        </table>
    </div>

    <div id="taskhistory" class="tab-content">
        <table>
            <tr>
                <th>History ID</th>
                <th>Task ID</th>
                <th>Action</th>
                <th>Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>1</td>
                <td>Created</td>
                <td>2024-05-20</td>
            </tr>
        </table>
    </div>

    <div id="tags" class="tab-content">
        <table>
            <tr>
                <th>Tag ID</th>
                <th>Tag Name</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>Important</td>
            </tr>
        </table>
    </div>

    <div id="notifications" class="tab-content">
        <table>
            <tr>
                <th>Notification ID</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>You have a new task.</td>
                <td>2024-05-21</td>
            </tr>
        </table>
    </div>

    <div id="taskdependencies" class="tab-content">
        <table>
            <tr>
                <th>Dependency ID</th>
                <th>Task ID</th>
                <th>Depends On Task ID</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>2</td>
                <td>1</td>
            </tr>
        </table>
    </div>

    <div id="projects" class="tab-content">
        <table>
            <tr>
                <th>Project ID</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            <!-- Sample data -->
            <tr>
                <td>1</td>
                <td>Alphonse DieumeMerci</td>
                <td>2024-05-01</td>
                <td>2024-12-31</td>
            </tr>
        </table>
    </div>

    <script>
        function openTab(event, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tab contents
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the active class from all tab links
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        // Open the first tab by default
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".tab-button").click();
        });
    </script>
    <!-- Back to Dashboard Link -->
<a class="back-to-dashboard" href="admindashboard.php">Back to Dashboard</a>
</body>
</html>
