import React from "react";
import './App.css';
import './main.css';
import Slider from './components/Slider/Slider';
import Result from './components/Result/Result';
import ListWrapper from './components/ListWrapper/ListWrapper';
import Form2 from './components/Form2/Form2';
import Footer from './components/Footer/Footer';
import MapWrapper from "./components/MapWrapper/MapWrapper";

const connections = [

  {
    from: [1, 5],
    to: [2, 10]
  },
  {
    from: [3, 6],
    to: [9, 12]
  }

];

class App extends React.Component{

  state = {
    connections: [...connections],  
  }

  setRoute = (e) => {
    e.preventDefault();

     const newItem = {
       from: [e.target[0].value, e.target[1].value],
       //to: [e.target[2].value, e.target[3].value]
     };


    this.setState(prevState => ({
      connections: [...prevState.connections, newItem],
    })) 

    e.target.reset();
  }
  render(){
    return(
      <div className="bg-gray-300 container flex flex-wrap p-5">
        <h1 className="bg-gray-500 container p-6 text-center">Projekt grupowy</h1>
        <Slider />
        <div className="container my-6 flex">
          <MapWrapper connections={this.state.connections}/>
          <Form2 submitFn={this.setRoute}/>
        </div>
        <Result connections={this.state.connections}/>
        <Footer />
      </div>
    );
  }

};

export default App;