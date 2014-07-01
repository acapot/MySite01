// JavaScript Document

//Created by Alexis Capot 2012		
		function changeButtonNameCall(e){
			buttonObj.changeButtonName(e);
			}
		
		
//Constructor to show or hide the documents in my CV	
		function Button (){			
			this.init=function(){
					this.buttonShow=document.getElementsByClassName('click');
					addCrossBrowseEventListener(this.buttonShow, 'click',changeButtonNameCall);//changeButtonNameCall is to call this.changeButtonName but outsite
					this.parent="";
					this.btnElem="";
					this.index;
					this.imgClassIntyg;
					this.imgElement;
					this.parent;
					this.cutInnerHtml;	
					}//end init	
					
			this.getElemtImg=function (button){
					this.index = button.getAttribute("data-number")-1;
					this.imgClassIntyg=document.getElementsByClassName('intyg')[this.index];
					return this.imgClassIntyg;					
					}//end getElemtImg	
			
			this.changeButtonName = function (e){				
					if (!e) e=window.event;
										
					this.btnElem = getEventElem(e);
					this.imgElement = this.getElemtImg(this.btnElem);					
					console.log(btnElem.parentNode);
					this.parent=btnElem.parentNode;
				
							
					if (this.btnElem.innerHTML.search("Se")!=-1)
					{
						this.cutInnerHtml=this.btnElem.innerHTML.substr(2);
						this.btnElem.innerHTML="Dölj"+this.cutInnerHtml;
						this.imgElement.style.display='block';						
					}
					else{
						this.cutInnerHtml=this.btnElem.innerHTML.substr(4);
						this.btnElem.innerHTML="Se"+this.cutInnerHtml;
						this.imgElement.style.display='none';
					}										
				}//end changeButtonName		
		} //end objet Button		
	
		var buttonObj = new Button();
		appendEventHandler(window, "load", buttonObj.init,false);
