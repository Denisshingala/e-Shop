const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");
const type = document.getElementById("type");
const typeForm = document.getElementById("type-form");
const seller = document.getElementById("seller");
const user = document.getElementById("user");

signUpButton.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

const next = (event) => {
	const name = type.value;
	typeForm.classList.add('d-none')

	if (name === "seller")
		seller.classList.remove('d-none');
	else
		user.classList.remove('d-none');
	type.value = "seller";
};

const backUser = () => {
	typeForm.classList.remove('d-none')
	user.classList.add('d-none');
};

const backSeller = () => {
	typeForm.classList.remove('d-none')
	seller.classList.add('d-none');
};

const userValidation = (event) => {
	let password = document.getElementById("user-pass").value;
	let confirmpassword = document.getElementById("user-confirmpass").value;

	if (password !== confirmpassword) {
		alert('Oops! password and confirm password is not match...');
		return false;
	}
}
const sellerValidation = (event) => {
	let password = document.getElementById("seller-pass").value;
	let confirmpassword = document.getElementById("seller-confirmpass").value;

	if (password !== confirmpassword) {
		alert('Oops! password and confirm password is not match...');
		return false;
	}
}