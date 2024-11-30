let slideIndex = 0;

// Hàm để hiển thị slide
showSlides();

// Hàm chuyển đổi slide
function showSlides() {
  let slides = document.getElementsByClassName("mySlides");

  // Ẩn tất cả các slide
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;
  // Nếu vượt quá số lượng slide, quay lại slide đầu tiên
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  // Hiển thị slide hiện tại
  slides[slideIndex - 1].style.display = "block";

  // Chuyển đến slide tiếp theo sau 3 giây
  setTimeout(showSlides, 3000);
}

// Hàm điều khiển chuyển slide (trước, sau)
function plusSlides(n) {
  slideIndex += n;
  let slides = document.getElementsByClassName("mySlides");

  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  if (slideIndex < 1) {
    slideIndex = slides.length;
  }
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex - 1].style.display = "block";
}

$(document).ready(function () {
  // Định nghĩa hàm xử lý sự kiện click trên thẻ <a>
  function handleDropdownItemClick() {
    var brand = $(this).text();
    console.log(brand);
  }

  // Gán sự kiện click cho các thẻ <a> trong dropdown
  $(".dropdown-content a").click(handleDropdownItemClick);

  // Hàm khác muốn gọi lại hàm xử lý sự kiện click
  function anotherFunction() {
    // Gọi lại hàm xử lý sự kiện click trên thẻ <a>
    handleDropdownItemClick.call($(".dropdown-content a")[0]);
  }
});
