<?php
session_start();
if(!isset($_SESSION['admin'])){$_SESSION['admin']=0;};

$conn = new PDO('sqlite:base.db');

$conn->exec("CREATE TABLE IF NOT EXISTS projets(
									id INTEGER PRIMARY KEY,
									nom TEXT,
									date TEXT,
									type TEXT,
									vignette TEXT,
									resume TEXT,
									description TEXT,
									lien TEXT,
									contact TEXT);");

$conn->exec("CREATE TABLE IF NOT EXISTS photos(
									id INTEGER PRIMARY KEY,
									idProjet INTEGER,
									nom TEXT,
									date TEXT);");
?>
