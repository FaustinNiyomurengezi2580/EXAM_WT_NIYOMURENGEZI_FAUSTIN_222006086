<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports for Task Management Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: orange;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background:yellow;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }

        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }

        header ul {
            padding: 0;
            list-style: none;
        }

        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }

        .reports {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .report-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .report-description {
            margin-bottom: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Admin Reports Generate</h1>
            
        </div>
    </header>

    <div class="container">
        <div class="reports">
            <div class="report">
                <div class="report-title">1. User Activity Report</div>
                <div class="report-description">
                    This report provides a summary of user activities, including tasks created, tasks assigned, and tasks completed by each user over a specified period.
                </div>
            </div>
            <div class="report">
                <div class="report-title">2. Task Completion Report</div>
                <div class="report-description">
                    This report details the tasks that have been completed within a specified timeframe, highlighting the due dates, completion dates, and the users who completed them.
                </div>
            </div>
            <div class="report">
                <div class="report-title">3. Overdue Tasks Report</div>
                <div class="report-description">
                    This report lists all tasks that are overdue, providing information on the assigned users, original due dates, and the current status of each task.
                </div>
            </div>
            <div class="report">
                <div class="report-title">4. Task Assignment Report</div>
                <div class="report-description">
                    This report shows the distribution of tasks among users, allowing the admin to see the workload of each user and ensure tasks are evenly assigned.
                </div>
            </div>
            <div class="report">
                <div class="report-title">5. Project Progress Report</div>
                <div class="report-description">
                    This report provides an overview of the progress of each project, including the number of tasks completed, tasks in progress, and tasks yet to be started.
                </div>
            </div>
            <div class="report">
                <div class="report-title">6. Task Prioritization Report</div>
                <div class="report-description">
                    This report lists tasks based on their priority levels, helping the admin to identify high-priority tasks that need immediate attention.
                </div>
            </div>
            <div class="report">
                <div class="report-title">7. User Performance Report</div>
                <div class="report-description">
                    This report evaluates the performance of each user based on the number of tasks completed, the time taken to complete tasks, and adherence to deadlines.
                </div>
            </div>
            <div class="report">
                <div class="report-title">8. Task Status Report</div>
                <div class="report-description">
                    This report provides a snapshot of the current status of all tasks, categorizing them as not started, in progress, or completed.
                </div>
            </div>
            <div class="report">
                <div class="report-title">9. Project Budget Report</div>
                <div class="report-description">
                    This report tracks the budget allocation and expenditures for each project, helping the admin to monitor financial performance and budget adherence.
                </div>
            </div>
            <div class="report">
                <div class="report-title">10. Time Tracking Report</div>
                <div class="report-description">
                    This report tracks the amount of time spent on each task by users, providing insights into productivity and time management.
                </div>
            </div>
            <div class="report">
                <div class="report-title">11. Resource Utilization Report</div>
                <div class="report-description">
                    This report shows how resources, such as manpower and tools, are being utilized across projects, helping to optimize resource allocation.
                </div>
            </div>
            <div class="report">
                <div class="report-title">12. Task Dependency Report</div>
                <div class="report-description">
                    This report lists tasks along with their dependencies, helping to identify tasks that are waiting on other tasks to be completed before they can start.
                </div>
            </div>
            <div class="report">
                <div class="report-title">13. Task Aging Report</div>
                <div class="report-description">
                    This report shows how long tasks have been open, providing insights into tasks that have been pending for extended periods.
                </div>
            </div>
            <div class="report">
                <div class="report-title">14. Milestone Achievement Report</div>
                <div class="report-description">
                    This report tracks the achievement of project milestones, highlighting completed milestones and upcoming ones.
                </div>
            </div>
            <div class="report">
                <div class="report-title">15. Feedback and Issue Report</div>
                <div class="report-description">
                    This report compiles user feedback and issues reported during project execution, helping the admin to address concerns and improve project processes.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
