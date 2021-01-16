import React from "react";
import './App.css';
import './main.css';
import Slider from './components/Slider/Slider';
import Result from './components/Result/Result';
import ListWrapper from './components/ListWrapper/ListWrapper';
import Form from './components/Form/Form';
import Footer from './components/Footer/Footer';
import MapWrapper from "./components/MapWrapper/MapWrapper";

const connections = [

  // {
  //   from: [1, 5],
  //   to: [2, 10]
  // },
  // {
  //   from: [3, 6],
  //   to: [9, 12]
  // }

];

class App extends React.Component{

  state = {
    // connections: [...connections], 
    route: [], 
  }

  setRoute = (e) => {
    e.preventDefault();

     const newRoute = [
        {
          x: 10,
          y: 10,
          country: e.target[0].value,
          number: 999
        },
        {
          x: 70,
          y: 70,
          country: 'other country',
          number: 9999
        },
        {
          x: 40,
          y: 60,
          country: e.target[1].value,
          number: 69
        },
        {
          x: 70,
          y: 170,
          country: 'another country',
          number: 669
        }
     ];

     this.setState({
      route: [...newRoute],
    });

       //from: [e.target[0].value, e.target[1].value],
       //to: [e.target[2].value, e.target[3].value]
    //  };


    // this.setState(prevState => ({
    //   connections: [...prevState.connections, newItem],
    // })) 

    

    //zwraca tablice punktow x,y,nazwa,liczba zachorowan
    e.target.reset();
  }
  render(){
    return(
      <div className="bg-gray-300 container md:mx-auto flex flex-wrap">
        <h1 className="p-6 container text-center text-3xl text-bold">Projekt grupowy</h1>
        <Slider />
        <div className="container my-6 flex">
          <MapWrapper route={this.state.route}/>
          {/* <Form2 submitFn={this.setRoute}/> */}
          <Form submitFn={this.setRoute}/>
        </div>
        <Result route={this.state.route}/>
        <Footer />
      </div>
    );
  }

};

export default App;