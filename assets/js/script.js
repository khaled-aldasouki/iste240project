
window.onload = function(){showMenu()};

//function used to add a question when creating a survey
function addquestion(){
    
    let questions = document.getElementsByClassName("question");
    let n = questions.length ;
    let form = document.getElementById('newform');
    form.append(document.createElement('br'));

    //creating label
    const label = document.createElement('label');
    label.setAttribute('id','q'+n);
    label.setAttribute('for','q'+n);
    label.setAttribute('class','question');
    let node1 = document.createTextNode("Question " + n + ":");
    label.appendChild(node1);
    form.append(label);
    form.append(document.createElement('br'));

    //creating question box
    const question = document.createElement('textarea');
    question.setAttribute('name','q'+n);
    question.setAttribute('id','q'+n);
    question.setAttribute('required','true');
    question.placeholder = 'Enter the question here...'

    form.append(question);
    form.append(document.createElement('br'));

    //creating type label
    const typelabel = document.createElement('label');
    typelabel.setAttribute('for','q'+n+'type');
    let node2 = document.createTextNode("Question " + n + " type:");
    typelabel.appendChild(node2);
    form.append(typelabel);
    form.append(document.createElement('br'));

    //creating select
    const select = document.createElement('select');
    select.setAttribute('name','q'+n+'type');
    select.setAttribute('id','q'+n+'type');
    select.setAttribute('required','true');
    select.setAttribute('onchange','changetype('+n+');');
    form.append(select);
    form.append(document.createElement('br'));
    
    
    const option0 = document.createElement('option');
    option0.setAttribute('value','none');
    option0.setAttribute('hidden','true')
    option0.setAttribute('disabled','true')
    option0.setAttribute('selected','true')
    option0.innerHTML = 'Select an Option';

    const option1 = document.createElement('option');
    option1.setAttribute('value','textarea');
    option1.innerHTML = 'Text Box';
    const option2 = document.createElement('option');
    option2.setAttribute('value','truefalse');
    option2.innerHTML = 'True/False';
    const option3 = document.createElement('option');
    option3.setAttribute('value','mc');
    option3.innerHTML = 'Multiple Choice';
        
    select.append(option0,option1,option2,option3);

    form.append(document.createElement('br'));

    //creating div for options
    const div = document.createElement('div');
    div.setAttribute('id','options' + n);
    form.append(div);
    div.scrollIntoView();

}

//function used to chang the type of answer a question uses
function changetype(n){
    let brelem = document.createElement('br');
    let option = document.getElementById('q'+n+'type');
    let div = document.getElementById('options' + n);
    var val= option.value;
    while (div.firstChild) {
        div.removeChild(div.lastChild);
    }
    if (val == "textarea"){
        let node = document.createElement('textarea');
        node.style.width = '100%'
        node.placeholder = 'Enter any intial answer here...'
        node.setAttribute('name','q'+n+'textbox');
        div.append(node);
    } 
    else if (val == "mc"){
        
        let node1 = document.createElement('textarea');
        node1.placeholder = 'option 1';
        node1.setAttribute('class','multi');
        node1.setAttribute('required','true');
        node1.setAttribute('name','q'+n+'option1');

        let node2 = document.createElement('textarea');
        node2.placeholder = 'option 2';
        node2.setAttribute('class','multi');
        node2.setAttribute('required','true');
        node2.setAttribute('name','q'+n+'option2');

        let node3 = document.createElement('textarea');
        node3.placeholder = 'option 3';
        node3.setAttribute('class','multi');
        node3.setAttribute('required','true');
        node3.setAttribute('name','q'+n+'option3');

        let node4 = document.createElement('textarea');
        node4.placeholder = 'option 4';
        node4.setAttribute('class','multi');
        node4.setAttribute('required','true');
        node4.setAttribute('name','q'+n+'option4');


        div.append(node1,document.createElement('br'),node2,document.createElement('br'),node3,document.createElement('br'),node4);
    }
    else {
        let node1 = document.createElement('textarea');
        node1.placeholder = 'True';
        node1.setAttribute('class','multi');
        node1.setAttribute('maxlength','0');
        node1.setAttribute('name','q'+n+'bool1');

        let node2 = document.createElement('textarea');
        node2.placeholder = 'False';
        node2.setAttribute('class','multi');
        node2.setAttribute('maxlength','0');
        node2.setAttribute('name','q'+n+'bool2');
        div.append(node1,document.createElement('br'),node2,document.createElement('br'));
    }
}   

function validateNewForm(){
    let n = document.getElementsByClassName("question").length;
    for (let i=1;i<=n;i++){
        if (document.forms["newform"]["q"+i+"type"].value == "none"){
            alert("Select an answer type for question " + i);
            return false;
        }
    }
    return true;
}


function showMenu(){
    var nav = document.getElementById("nav");
    if (nav.style.visibility == "hidden"){
        nav.style.visibility = "visible";   
        nav.style.opacity=1; }
    else{
      if (window.innerWidth < 768){
        nav.style.visibility = "hidden";
        nav.style.opacity=0; }

    }
}

