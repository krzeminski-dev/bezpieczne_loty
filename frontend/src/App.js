import React from "react";
import './App.css';
import './main.css';
import Slider from './components/Slider/Slider';
import Result from './components/Result/Result';
import Form from './components/Form/Form';
import Footer from './components/Footer/Footer';
import MapWrapper from "./components/MapWrapper/MapWrapper";
import {sample} from "./SampleRoutes";
class App extends React.Component {

    state = {
        source: null,
        destination: null,
        path: [],
        route: [],
    }

    handleCallback = (childData) => {

        const source = childData.source.value;
        const destination = childData.destination.value;

        this.setState({
            source: childData.source,
            destination: childData.destination
        })

        const pathUrl = `http://localhost/api/route?source=${source}&destination=${destination}`;
        console.log(pathUrl);

        fetch(pathUrl)
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        path: [].concat.apply([], result) // flatten array
                    });
                },
                (error) => {
                    this.setState({
                        error
                    });
                }
            )
    }

    setRoute = (e) => {
        e.preventDefault();

        this.setState({
            sampleRoutes: [...sample]
        });

        e.target.reset();
    }

    handleCheck = (index) => {
        this.setState(prevState => ({
            sampleRoutes: prevState.sampleRoutes.map((el, id) => (id === index ? {...el, onMap: !el.onMap} : el))
        }));
    }

    render() {
        return (
            <div className="bg-gray-300 container md:mx-auto flex flex-wrap">
                <h1 className="p-6 container text-center text-3xl text-bold">Projekt grupowy</h1>
                <Slider/>
                <div className="container my-6 flex">
                    <MapWrapper route={this.state.route} path={this.state.path}/>
                    <Form
                        parentCallback = {this.handleCallback}
                    />
                </div>
                {/*<Result route={this.state.route}*/}
                {/*        tempo={this.state.tempo}*/}
                {/*        sampleRoutes={this.state.sampleRoutes}*/}
                {/*        checkHandler={this.handleCheck}/>*/}
                {/*<Footer/>*/}
            </div>
        );
    }

}

export default App;