$(document).foundation();
// alert("This is for TESTING purposes only");
lohudmetrics({
    'pagename': 'The Journal News/lohud.com Voter Database',
    'author': 'Kai Teoh'
});

function TdMouseOver(){
    this.className += ' mouseover';
}

var elements = document.getElementsByTagName('td');

for (var i=0; i<elements.length; i++) {
    elements[i].onmouseover = TdMouseOver;
}
