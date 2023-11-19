var currentPath = window.location.pathname;
if (currentPath.endsWith(".html")) {
    var newPath = currentPath.replace(".html", ".php");
    window.location.href = newPath;
}
