import React from "react";
import './App.css';
import './main.css';
import Slider from './components/Slider/Slider';
import Result from './components/Result/Result';
import Form from './components/Form/Form';
import Footer from './components/Footer/Footer';
import MapWrapper from "./components/MapWrapper/MapWrapper";
import {sample} from "./SampleRoutes";

const sztywnaTrasa = [
    [
      {
        "id": 4,
        "name": "Andorra",
        "iso2": "AD",
        "iso3": "AND",
        "latitude": 42.5,
        "longitude": 1.6,
        "flag": "https://disease.sh/assets/img/flags/ad.png",
        "population": 77335
      }
    ],
    [
      {
        "id": 8,
        "name": "Argentina",
        "iso2": "AR",
        "iso3": "ARG",
        "latitude": -34,
        "longitude": -64,
        "flag": "https://disease.sh/assets/img/flags/ar.png",
        "population": 45430461
      }
    ]
  ];

class App extends React.Component {

    state = {
        source: null,
        destination: null,
        path: [],
        route: sztywnaTrasa.flat()
    }

    handleCallback = (childData) => {

        const source = childData.source.value;
        const destination = childData.destination.value;

        this.setState({
            source: childData.source,
            destination: childData.destination
        })

        const pathUrl = `http://172.20.0.5/api/route?source=${source}&destination=${destination}`;
        console.log(pathUrl);

        fetch(pathUrl)
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        path: [].concat.apply([], result), // flatten array
                        //route: result.flat()
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

    //do usuniecia
    tempo = () => {
        this.setState({
            route: [{"id":2,"name":"Albania","iso2":"AL","iso3":"ALB","latitude":41,"longitude":20,"flag":"https://disease.sh/assets/img/flags/al.png","population":2876076},{"id":56,"name":"Diamond Princess","iso2":null,"iso3":null,"latitude":0,"longitude":0,"flag":"https://disease.sh/assets/img/flags/unknown.png","population":0},{"id":127,"name":"Marshall Islands","iso2":"MH","iso3":"MHL","latitude":9,"longitude":168,"flag":"https://disease.sh/assets/img/flags/mh.png","population":59408},{"id":119,"name":"Macao","iso2":"MO","iso3":"MAC","latitude":22.1667,"longitude":113.55,"flag":"https://disease.sh/assets/img/flags/mo.png","population":654136},{"id":214,"name":"Vanuatu","iso2":"VU","iso3":"VUT","latitude":-16,"longitude":167,"flag":"https://disease.sh/assets/img/flags/vu.png","population":311011},{"id":18,"name":"Belarus","iso2":"BY","iso3":"BLR","latitude":53,"longitude":28,"flag":"https://disease.sh/assets/img/flags/by.png","population":9447622}].flat()
        })
    }

    render() {
        return (
            <div className="bg-gray-300 container md:mx-auto flex flex-wrap">
                <h1 onClick={this.tempo} className="p-6 container text-center text-3xl text-bold">Projekt grupowy </h1>
                {/* <div>
                    {this.state.route.map(el => el)}
                </div> */}
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