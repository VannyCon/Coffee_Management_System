<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursery Owners</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
     .timeline-container {
    max-width: 100%;
    margin: 50px auto;
    background-color: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #333;
}

.timeline {
    position: relative;
    padding-left: 20px; /* Add left padding to make room for the line */
}

.timeline::before {
    content: '';
    position: absolute;
    width: 2px;
    background-color: #ccc;
    top: 0;
    bottom: 0;
    left: 5px; /* Adjust the left position */
}

.timeline-item {
    display: flex;
    align-items: flex-start; /* Align items to the top */
    margin-bottom: 20px;
    position: relative;
}

.timeline-time {
    width: 55px;
    font-size: 0.7rem;
    text-align: right;
    padding-right: 15px;
    color: #666;
    flex-shrink: 0; /* Prevent the time from shrinking */
}

.timeline-content {
    background-color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    flex-grow: 1; /* Allow the content to grow and fill available space */
}

.timeline-content h3 {
    margin: 0;
    font-size: 1rem;
    color: #333;
}

.timeline-content p {
    margin: 5px 0 0;
    font-size: 0.9rem;
    color: #666;
}

.timeline-item::before {
    content: '';
    position: absolute;
    width: 12px;
    height: 12px;
    background-color: #666;
    border-radius: 50%;
    left: -20px; /* Adjust the left position to align with the line */
    top: -1px; /* Adjust top position to align with the content */
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.my-bg-success{
    background-color: #e4f2e4;
}
.my-bg-warning{
    background-color: #f2f0e4;
}
.my-bg-info{
    background-color: #d3e4f2;
}
.my-bg-danger{
    background-color: #f2e4e4;
}
</style>