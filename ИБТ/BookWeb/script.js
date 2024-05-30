
//Извикване на формите
function showForm(formId) {
    const form = document.getElementById(formId);
    form.classList.remove('hidden');
}

function closeForm(formId) {
    const form = document.getElementById(formId);
    form.classList.add('hidden');
}

//Ревюта
const allStar = document.querySelectorAll('.rating .star')
const ratingValue = document.querySelector('.rating input')

allStar.forEach((item, idx)=> {
	item.addEventListener('click', function () {
		let click = 0
		ratingValue.value = idx + 1

		allStar.forEach(i=> {
			i.classList.replace('bxs-star', 'bx-star')
			i.classList.remove('active')
		})
		for(let i=0; i<allStar.length; i++) {
			if(i <= idx) {
				allStar[i].classList.replace('bx-star', 'bxs-star')
				allStar[i].classList.add('active')
			} else {
				allStar[i].style.setProperty('--i', click)
				click++
			}
		}
	})
})

//Попъп

let popup = document.getElementById("popup");

function showPopup() {
	var name = document.querySelector('#purchaseForm .input_field[type="text"]').value;
    
    var popupMessage = document.getElementById('popupMessage');
    
    popupMessage.textContent = popupMessage.textContent.replace('%Име%', name);
	
	popup.classList.add("show-popup");
}

function closePopup() {
	var name = document.querySelector('#purchaseForm .input_field[type="text"]').value;
    
    var popupMessage = document.getElementById('popupMessage');
    
    popupMessage.textContent = popupMessage.textContent.replace(name, '%Име%');

	popup.classList.remove("show-popup");
}

function resetPurchaseForm() {
	document.getElementById('name').value = '';
    document.getElementById('name').setAttribute('placeholder', 'Въведете цялото име');
    document.getElementById('cardNumber').value = '';
    document.getElementById('cardNumber').setAttribute('placeholder', '0000 0000 0000 0000');
    document.getElementById('expiryDate').value = '';
    document.getElementById('expiryDate').setAttribute('placeholder', '01/23');
	document.getElementById('cvvNum').value	= '';
	document.getElementById('cvvNum').setAttribute('placeholder', 'CVV');
}

function resetReviewForm() {
	document.getElementById('reviewerName').value = '';
    document.getElementById('reviewerName').setAttribute('placeholder', 'Въведете цялото име');
	document.getElementById('reviewArea').value = '';
    document.getElementById('reviewArea').setAttribute('placeholder', 'Вашето мнение...');
}

function submitReview(event) {
    event.preventDefault();

    var reviewerName = document.getElementById('reviewerName').value;
    var reviewText = document.getElementById('reviewArea').value;

    var reviewElement = document.createElement('div');
    reviewElement.classList.add('review');

    var finalReview = document.createElement('p');
	var textNode = document.createTextNode(reviewerName + ': ' + reviewText);
    finalReview.appendChild(nameElement);

	reviewElement.InsertBefore(finalReview);
}

//login

var lgn = document.getElementById("login");
var rgstr = document.getElementById("register");
var btn = document.getElementById("btn");

function register() {
	lgn.style.left = "-400px";
	rgstr.style.left = "50px";
	btn.style.left = "110px";
}

function login() {
	lgn.style.left = "50px";
	rgstr.style.left = "450px";
	btn.style.left = "0px";
}