



document.addEventListener('DOMContentLoaded', function() {
  const menuButton = document.getElementById('menu-button');
  const navigation = document.getElementById('navigation');

  menuButton.addEventListener('click', function() {
      navigation.classList.toggle('hidden');
  });
});



