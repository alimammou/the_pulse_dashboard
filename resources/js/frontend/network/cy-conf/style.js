export default `
core {
	active-bg-color: #fff;
	active-bg-opacity: 0.333;
}

edge {
	curve-style: haystack;
	haystack-radius: 0;
	opacity: 0.333;
	width: 2;
	z-index: 0;
	overlay-opacity: 0;
  events: no;
  	line-color: #96D2EE;

}

node {

	font-size: 11;
	// font-weight: bold;
	min-zoomed-font-size: 4;
	label: data(name);
	text-wrap: wrap;
	text-max-width: 50;
	text-valign: center;
	text-halign: center;
	text-events: yes;
	color: #ffffff;
	text-outline-width: 0.5;
	 text-outline-color: #00000;
	text-outline-opacity: 0.5;
	overlay-color: #fff;

}

edge[interaction = "cc"] {
	line-color: #FACD37;
	opacity: 0.666;
	z-index: 9;
	width: 4;
}

node[NodeType = "Cheese"],
node[NodeType = "CheeseType"] {
	background-color: #FACD37;
	text-outline-color: #00;
}

node[NodeType = "Cheese"][Quality],
node[NodeType = "CheeseType"][Quality] {
	width: mapData(Quality, 70, 100, 20, 50);
	height: mapData(Quality, 70, 100, 20, 50);
}

node[NodeType = "WhiteWine"] {
	background-color: #6DC495;
	text-outline-color: #000000;
		width: 90;
	height: 90;
     border-width: 1;
      border-color: 'green';
}

edge[interaction = "cw"] {
	line-color: white;
}

node[NodeType = "RedWine"] {
	background-color: #2CA5DD;
	text-outline-color: #000000;
		width: 60;
	height: 60;
	     border-width: 0.5;
      border-color: 'green';
}

edge[interaction = "cr"] {
	line-color: #DE3128;
}

node[NodeType = "Cider"] {
	background-color: #A4EB34;
	text-outline-color: #A4EB34;
}

node.highlighted {
	min-zoomed-font-size: 0;
  z-index: 9999;
}

edge.highlighted {
	opacity: 0.8;
	width: 4;
	z-index: 9999;
}

.faded {
  events: no;
}

node.faded {
  opacity: 0.08;
}

edge.faded {
  opacity: 0.06;
}

.hidden {
	display: none;
}

`;
