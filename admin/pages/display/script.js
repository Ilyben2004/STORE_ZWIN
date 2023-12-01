
document.addEventListener("DOMContentLoaded", function () {
  let selectMenu = document.querySelector("#products");
  let container = document.querySelector(".content_users");

  selectMenu.addEventListener("change", function () {
   
      let categoryName = this.value;
     

      let http = new XMLHttpRequest();

      http.onreadystatechange = function () {
      
          if (this.readyState === 4 && this.status === 200) {
              let response = JSON.parse(this.responseText);
            
              let out = `
              <div class="content_users">
              <table>
              <thead>
              <tr>
                  <td>Image Product</td>
                  <td>Title</td>
                  
                  <td>Price</td>
                  <td>Category</td>
                  <td>Quantity</td>
                  <td>Actions</td>
              </tr>
              </thead>
          `;
          
         if(response!=0){
         

              for (let item of response) {
               
                  out += `<tr`;

if (item.Quantity <= 0) {
  out += " class=\"red_row\"";
}

out += `>
  <td><img src="../../../product_images/${item.image_file}" alt="" height="50px" width="50px"></td>
  <td>${item.title}</td>
  <td>${item.PRIX}</td>
  <td>${item.Category_name}</td>
  <td>${item.Quantity}</td>
  <td>
      <a href="modify/modify.php?var=${item.id}">
          <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="48" height="48" fill="white" fill-opacity="0.01"></rect> <path d="M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z" fill="#2F88FF" stroke="#000000" stroke-width="4" stroke-linejoin="round"></path> </g></svg>
      </a>
  </td>
</tr>`;

              }}
          
              out+=" </table> </div>";
              container.innerHTML = out;
          }
      };

      http.open('POST', "script.php", true);
      http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      http.send("category=" + categoryName);
  });
});



$(document).ready(function(){
    $('#search').on("keyup", function(){
      var getName = $(this).val();
     
      $.ajax({
        method: 'POST',
        url: 'searchajax.php',
        data: { name: getName },
        success: function(response) {
             $("#showdata").html(response);
        } 
      });
    });
 });
 


let sourceDiv = document.querySelector('.display');
let targetDiv = document.querySelector('.menu-wrap');

// Get the computed height of the source div
let sourceHeight = window.getComputedStyle(sourceDiv).getPropertyValue('height');

// Set the height of the target div to match the height of the source div
let numericHeight = parseFloat(sourceHeight);

// Add 20 pixels to the numeric height
let adjustedHeight = numericHeight + 85;

// Set the height of the target div with the adjusted height
