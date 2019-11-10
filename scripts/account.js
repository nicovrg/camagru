/* ==================== dropdown script====================
** This script display or hide the dropdown account menu
** myFunction => When the user clicks on the button, toggle between hiding and showing the dropdown content 
** window.onclick = function (e) => Close the dropdown if the user clicks outside of it
*/

function myFunction() 
{
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(e) 
{
	if (!e.target.matches('.dropbtn')) 
	{
		var myDropdown = document.getElementById("myDropdown");
		if (myDropdown.classList.contains('show')) 
			myDropdown.classList.remove('show');
  }
}
