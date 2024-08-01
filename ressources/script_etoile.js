
function selectEtoileA(aEtoiles, bUnselect, iNote, sClassSlelected){
    for(var h = 0; h < aEtoiles.length; h++) {
      let oClass = aEtoiles[h].classList;
      if(bUnselect==false && h <= iNote - 1 ){
        oClass.add(sClassSlelected);
      }else{
        oClass.remove(sClassSlelected);
      }
    }
  }
  
  function selectEtoileTemp(oEvent){
    var oEl = oEvent.currentTarget,
        oFormExempleA =  oEl.parentNode,
        aEtoilesExempleA = oFormExempleA.getElementsByClassName('etoile'),
        sClassSlelected = 'gold';
    selectEtoileA(aEtoilesExempleA, false, (oEvent.type == 'mouseleave')? oFormExempleA.note.value:oEl.iNote, sClassSlelected);
  }
  
  function selectEtoileB(oEvent){
    var oEl = oEvent.currentTarget,
        sClass = "selected"; 
    if(oEvent.type == 'mouseleave'|| oEvent.type == 'touchend'){
      oEl.classList.remove(sClass);
    }else{
      oEl.classList.add(sClass);
    } 
  }
  document.addEventListener('DOMContentLoaded',function(){
   
    
    var oFormExempleA =  document.forms["etoileNote"],
        aEtoilesExempleA = oFormExempleA.getElementsByClassName('etoile');
    for(var i = 0; i< aEtoilesExempleA.length;i++) {
      aEtoilesExempleA[i].iNote = i+1;
      aEtoilesExempleA[i].addEventListener('mouseleave',selectEtoileTemp);
      aEtoilesExempleA[i].addEventListener('mouseenter',selectEtoileTemp);
      aEtoilesExempleA[i].addEventListener('click', function(oEvent){
        var oEl = oEvent.currentTarget,  
            sClassSlelected = 'gold',
            hasClass = oEl.classList.contains(sClassSlelected),
            bUnselect = hasClass && oEl.iNote == 1 && oFormExempleA.note.value == 1;
        oFormExempleA.note.value =  bUnselect? 0:oEl.iNote;
        selectEtoileA(aEtoilesExempleA, bUnselect, oEl.iNote, sClassSlelected);
      }); 
      if(oFormExempleA.note.value - 1 == i){
        aEtoilesExempleA[i].click();
      }
    } 
  });