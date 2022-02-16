import 'code-prettify';
// import * as codePrettify from "./../../node_modules/code-prettify/src/prettify.js";

window.addEventListener("load", function() {

	PR.prettyPrint();

	// store tabs constiables
	const tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (let i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		const clickedTab = event.currentTarget;
		const anchor = event.target;
		const activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}
});


jQuery(document).ready(function ($) {
	$(document).on('click', '.js-image-upload', function (e) {
		e.preventDefault();
		const $button = $(this);

		const file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select or Upload an Image',
			library: {
				type: 'image' // mime type
			},
			button: {
				text: 'Select Image'
			},
			multiple: false
		});

		file_frame.on('select', function() {
			const attachment = file_frame.state().get('selection').first().toJSON();
			$button.siblings('.image-upload').val(attachment.url).trigger("change");;
		});

		file_frame.open();
	});
});