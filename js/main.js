function toggleSidebar() {
	$(".sidebar").toggleClass("collapsed");
	const closed = $(".sidebar").hasClass("collapsed");
	let padding =  closed || window.matchMedia('(max-width: 600px)').matches ? "0vw" : "16rem";
	$(".content").css({"padding-left": padding});
}

