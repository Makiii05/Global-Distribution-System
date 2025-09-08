<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = trim($_POST['prompt']);
    $parts   = explode(' ', $command);
    $action  = strtolower($parts[0]);
    $name    = $parts[1] ?? '';

    if ($action === 'mkdir' && !empty($name)) {
        $folderPath = __DIR__ . "/" . $name;

        if (!file_exists($folderPath)) {
            if (mkdir($folderPath, 0777, true)) {
                insertPrompt($name, 'directory');
            } else {
                insertPrompt("Failed to create folder: $name", 'error');
            }
        } else {
            insertPrompt("Folder already exists: $name", 'error');
        }

    } elseif ($action === 'touch' && !empty($name)) {
        $filePath = __DIR__ . "/" . $name;

        if (!file_exists($filePath)) {
            if (file_put_contents($filePath, "") !== false) {
                insertPrompt($name, 'file');
            } else {
                insertPrompt("Failed to create file: $name", 'error');
            }
        } else {
            insertPrompt("File already exists: $name", 'error');
        }

    } elseif ($action === 'ls') {
        $files = scandir(getcwd());
        $fileList = implode(' ', array_diff($files, ['.', '..']));
        insertPrompt($fileList, 'ls');

    } elseif ($action === 'clear') {
        clearPrompt();

    } else {
        insertPrompt("Command not found: $action", 'error');
    }

    header("Location: index.php");
    exit();
}

function insertPrompt(string $name, string $type): void {
    $conn = new mysqli("localhost", "root", "", "cmd");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO prompt (name, type) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $type);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

function clearPrompt(): void {
    $conn = new mysqli("localhost", "root", "", "cmd");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->query("TRUNCATE TABLE prompt");
    $conn->close();
}
