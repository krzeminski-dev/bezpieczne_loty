import React from "react";

const regex = /[\d`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/; //na zewnatrz

class Form extends React.Component {
 
      state = {
        from: "",
        fromValid: 1, 
        fromError: "",
        showFromError: true, 
        
        to: "",
        toValid: 1,
        toError: "",
        showToError: true,

        };

        handleFromChange = e => {
            this.setState({ from: e.target.value,
                            fromValid: 0,
                            });
        
            if(!e.target.value.trim()){
                      this.setState({ 
                        fromError: 'To pole nie moze byc puste',
                        fromValid: 1
                      });
                      } 
                
            else if((regex.test(e.target.value))){ 
                      this.setState(
                        { 
                            fromError: 'Pole zawiera nieprawidlowa wartosc',
                            fromValid: 1
                      });
                      }
            else{
                this.setState({
                    fromError: '',
                    fromValid: 0
                })
             }
          };
        
          handleFromFocus = () => {
            this.setState({
                showFromError: true
            })
          }
        
          handleFromBlur = () => {
             this.setState({
                 showFromError: false
             })
          }
        
          handleToChange = e => {
            this.setState({ to: e.target.value,
                            toValid: 0,
                            });

            if(!e.target.value.trim()){
                this.setState({ 
                    toError: 'To pole nie moze byc puste',
                    toValid: 1
                    });
                } 
                
            else if((regex.test(e.target.value))){ 
                this.setState({ 
                    toError: 'Pole zawiera nieprawidlowa wartosc',
                    toValid: 1
                    });
                }
        
            else{
                this.setState({
                    toError: '',
                    toValid: 0
                })
            }
        };
        
          handleToFocus = () => {
            this.setState({
                showToError: true
            })
         };
        
          handleToBlur = () => {
            this.setState({
                showToError: false
            })
         };
        
        
          render() {
        
            const errors = [this.state.fromValid, this.state.toValid];
            const isDisabled = Object.keys(errors).some(x => errors[x]);
        
            return (

  <div className="mr-6 form-wrap flex-1 p-6 bg-gray-200 rounded shadow-sm self-center">
       <p className="text-center bg-white -m-6 mb-6 p-6 font-bold rounded rounded-b-none border-b border-gray-400">Podaj informacje</p>
       <form onSubmit={this.props.submitFn}>
            
            <label className="block mb-3">Miejsce wylotu</label>
            <input name="from" id="from" className={`${errors.from ? "error" : ""} relative block box-border p-2  rounded border-gray-400 border`} type="text" placeholder="Skąd"
                value={this.state.from}
                onChange={this.handleFromChange}
                onBlur={this.handleFromBlur}
                onFocus={this.handleFromFocus}
                />
            {this.state.showFromError && this.state.fromError ? <p className="error__message text-red-700 text-sm mt-1">*{this.state.fromError}</p> : <p className="text-transparent">*</p>}
            
            
            <label className="block mb-3 mt-1">Cel trasy</label>
            <input name="to" id="to" className={`${errors.to ? "error" : ""} relative block box-border p-2 rounded border-gray-700 border`} type="text" placeholder="Dokąd"
                value={this.state.to}
                onChange={this.handleToChange}
                onBlur={this.handleToBlur}
                onFocus={this.handleToFocus}
                />
            {(this.state.showToError && this.state.toError) ? <p className="error__message text-red-700 text-sm mt-1">*{this.state.toError}</p> : <p className="text-transparent">*</p>}
               
               
               <button className={`${isDisabled ? "bg-gray-600 border-gray-700" : "bg-blue-800 border-blue-900 hover:bg-blue-700 hover:border-blue-800"} self-end focus:border-b-2 mt-3 container duration-300 text-white font-bold py-2 px-4 border-b-4 rounded`} 
               type="submit" disabled={isDisabled}>Szukaj trasy</button>
       </form>
  </div>
            )
          }}  

export default Form;