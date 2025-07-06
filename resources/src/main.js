import "@assets/css/styles.css";
import "htmx.org";
import { createIcons, icons } from "lucide";

createIcons({ icons });


function changeDir() {
  const currentDir = document.documentElement.getAttribute("dir") || "rtl";
  const newDir = currentDir === "ltr" ? "rtl" : "ltr";
  localStorage.setItem("dir", newDir);
  location.reload();
}

function changeTheme() {
  const currentTheme =
    document.documentElement.getAttribute("data-theme") || "dark";
  const newTheme = currentTheme === "light" ? "dark" : "light";
  localStorage.setItem("theme", newTheme);
  document.documentElement.setAttribute("data-theme", newTheme);
}

window.changeDir = changeDir;
window.changeTheme = changeTheme;
