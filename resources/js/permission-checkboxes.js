/*
|--------------------------------------------------------------------------
| Pemission Checkboxes Script
|--------------------------------------------------------------------------
*/

var checkboxes = document.querySelectorAll('.permission-checkbox-all input');

Array.prototype.forEach.call(checkboxes, function(el, i) {

  // Variables
  var value = el.value;
  var actionCheckboxes = document.querySelectorAll('.permission-checkbox-'+value+' input');

  // Check if all checkboxes are checked or not
  toggleAllChecked(value);

  // Make all checkboxes as checked or not
  el.addEventListener('change', (event) => {
      var actionCheckboxes = document.querySelectorAll('.permission-checkbox-'+(event.target.value)+' input');
      if (event.target.checked) {
        toggleAllCheckboxes(actionCheckboxes,true);
      } else {
        toggleAllCheckboxes(actionCheckboxes,false);
      }
  });

  // Check if all checkboxes are checked or not
  Array.prototype.forEach.call(actionCheckboxes, function(el, i) {
    el.addEventListener('change', (event) => {
      toggleAllChecked(value);
    });
  });

});

/**
 * Toggle all checkboxes of a column
 * @param  array checkboxes
 * @param  string value
 * @return void
 */
function toggleAllCheckboxes(checkboxes, value){
  Array.prototype.forEach.call(checkboxes, function(el, i) {
    el.checked = value;
  });
}

/**
 * Toggle the 'all' checkbox if all checkboxes are checked or not
 * @param  string value
 * @return void
 */
function toggleAllChecked(value){

    var parent = document.querySelector('.permission-checkbox-all input[value="'+value+'"]');
    var checkboxes = document.querySelectorAll('.permission-checkbox-'+value+' input');
    var isChecked = false;

    for(var i=0;i<checkboxes.length; ++i)
    {
      if(!checkboxes[i].checked)
      {
        isChecked = false;
        break;
      }
      isChecked = true;
    }

    parent.checked = isChecked;

}
