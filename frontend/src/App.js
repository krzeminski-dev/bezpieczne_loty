import React from "react";
import './App.css';
import './main.css';
import Slider from './components/Slider/Slider';
import Result from './components/Result/Result';
import ListWrapper from './components/ListWrapper/ListWrapper';
import Form from './components/Form/Form';
import Footer from './components/Footer/Footer';
import MapWrapper from "./components/MapWrapper/MapWrapper";
import {sample} from "./SampleRoutes";

const tempoHelper = [1,2,3,4];


class App extends React.Component{

  state = { 
    route: [], 
    tempo: [...tempoHelper],
    sampleRoutes: []
  }

  setRoute = (e) => { 
    e.preventDefault();

     this.setState({
      sampleRoutes: [...sample]
   });

    e.target.reset();
  }

    handleCheck = (index) => {
     this.setState(prevState=> ({
       sampleRoutes: prevState.sampleRoutes.map( (el, id) => (id === index ? {...el, onMap: !el.onMap} : el))
     }))
      console.log(this.state.sampleRoutes[index].onMap);
       console.log(index);

    }

  render(){
    return(
      <div className="bg-gray-300 container md:mx-auto flex flex-wrap">
        <h1 className="p-6 container text-center text-3xl text-bold">Projekt grupowy</h1>
        <Slider />
        <div className="container my-6 flex">
          <MapWrapper route={this.state.route} sampleRoutes={this.state.sampleRoutes}/>
          <Form submitFn={this.setRoute}/>
        </div>
        <Result route={this.state.route} 
                tempo={this.state.tempo} 
                sampleRoutes={this.state.sampleRoutes}
                checkHandler={this.handleCheck} />
        <Footer />
      </div>
    );
  }

};

export default App;