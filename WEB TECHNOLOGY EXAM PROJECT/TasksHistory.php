<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task History</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"], input[type="checkbox"], select {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }

        .status-icon {
            font-size: 1.5em;
            text-align: center;
        }

        .completed {
            color: green;
        }

        .pending {
            color: red;
        }

        .inprocess {
            color: orange;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Task History</h2>
        <table>
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="taskTableBody">
                <!-- Rows will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        // Sample data
        const tasks = [
            { TaskID: 1, title: "Time Tracking", description: "Monitor the time spent on each task and project.", status: "completed" },
            { TaskID: 2, title: "Document Management", description: "Store, organize, and share documents.", status: "pending" },
            { TaskID: 3, title: "Analytics and Reporting", description: "Gain insights into team performance.", status: "inprocess" },
            { TaskID: 4, title: "Notifications and Reminders", description: "Stay updated with real-time notifications.", status: "completed" },
            { TaskID: 5, title: "Integration with Other Tools", description: "Integrate with email, calendars, and more.", status: "pending" },
            { TaskID: 6, title: "Mobile Access", description: "Manage tasks on the go with our mobile app.", status: "completed" },
            { TaskID: 7, title: "Project Planning", description: "Plan and schedule tasks effectively.", status: "inprocess" },
            { TaskID: 8, title: "Team Collaboration", description: "Collaborate with team members in real-time.", status: "completed" },
            { TaskID: 9, title: "Task Prioritization", description: "Prioritize tasks to focus on what's important.", status: "pending" },
            { TaskID: 10, title: "Resource Allocation", description: "Allocate resources efficiently to tasks and projects.", status: "completed" }
        ];

        function loadTasks() {
            const tbody = document.getElementById('taskTableBody');
            tbody.innerHTML = '';
            tasks.forEach((task, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${task.TaskID}</td>
                    <td><input type="text" value="${task.title}" data-index="${index}" class="titleInput"></td>
                    <td><input type="text" value="${task.description}" data-index="${index}" class="descriptionInput"></td>
                    <td>
                        <select data-index="${index}" class="statusSelect">
                            <option value="completed" ${task.status === 'completed' ? 'selected' : ''}>Completed</option>
                            <option value="pending" ${task.status === 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="inprocess" ${task.status === 'inprocess' ? 'selected' : ''}>In Process</option>
                        </select>
                    </td>
                    <td class="status-icon ${task.status}">
                        ${task.status === 'completed' ? '✓' : task.status === 'pending' ? '✗' : '–'}
                    </td>
                    <td><button data-index="${index}" class="saveButton">Save</button></td>
                `;
                tbody.appendChild(row);
            });
        }

        function saveTask(index) {
            const titleInput = document.querySelector(`.titleInput[data-index="${index}"]`);
            const descriptionInput = document.querySelector(`.descriptionInput[data-index="${index}"]`);
            const statusSelect = document.querySelector(`.statusSelect[data-index="${index}"]`);
            
            tasks[index].title = titleInput.value;
            tasks[index].description = descriptionInput.value;
            tasks[index].status = statusSelect.value;
            
            loadTasks();
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadTasks();

            document.getElementById('taskTableBody').addEventListener('click', (event) => {
                if (event.target.classList.contains('saveButton')) {
                    const index = event.target.getAttribute('data-index');
                    saveTask(index);
                }
            });
        });
    </script>
</body>
</html>
