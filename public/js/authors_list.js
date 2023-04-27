function toggle_author(target, holder, event){
    console.log(event.currentTarget);

    // event.stopImmediatePropagation();
    if(event.currentTarget.parentElement == target){
        
        node = event.currentTarget.cloneNode(true);
        holder.append(node);
        event.currentTarget.remove();
    }else if(event.currentTarget.parentElement == holder){
        node = event.currentTarget.cloneNode(true);
        target.append(node);
        event.currentTarget.remove();
    }else{
        alert("(O_O)");
    }
    // console.warn(event.target.parentElement);
    // console.warn(_this);

}
function toggle_author_1(target, holder, template_form, template_holder){
    if(event.target.parentElement == target){
        node = template_holder.cloneNode(true);
        node.innerHTML = event.target.value;
        node.id="";
        holder.append(node);
        console.warn(target);
   
    }else if(event.target.parentElement == holder){
        node = template_form.cloneNode(true);
       // node.value = event.target.innerHTML;
        node.id="";
        target.append(node);
        console.log(holder);
    }else{
        alert("(O_O)");
    }
    console.log(template);

}