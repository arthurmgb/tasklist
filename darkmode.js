let darkMode = localStorage.getItem('darkMode'); 

const darkModeToggle = document.querySelector('#switch');
const $html = document.querySelector('html')

const enableDarkMode = () => {
  $html.classList.add('dark-mode');
  darkModeToggle.checked = true;
  localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
  $html.classList.remove('dark-mode');
  localStorage.setItem('darkMode', null);
}
 
if (darkMode === 'enabled') {
  darkModeToggle.checked = true;
  enableDarkMode();
}

darkModeToggle.addEventListener('click', () => {
  darkMode = localStorage.getItem('darkMode'); 
  if (darkMode !== 'enabled') {
    enableDarkMode();
  } else {  
    disableDarkMode(); 
  }
});
