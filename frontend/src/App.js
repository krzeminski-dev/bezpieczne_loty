import React from "react";
import "./App.css";
import "./main.css";
import Slider from "./components/Slider/Slider";
import Result from "./components/Result/Result";
import Form from "./components/Form/Form";
import Footer from "./components/Footer/Footer";
import MapWrapper from "./components/MapWrapper/MapWrapper";
class App extends React.Component {
  state = {
    source: null,
    destination: null,
    route: [],
    force: "empty",
  };

  handleCallback = (childData) => {
    const source = childData.source.value;
    const destination = childData.destination.value;

    this.setState({
      source: childData.source,
      destination: childData.destination,
      route: [],
      force: "calculate",
    });

    console.log("CALCULATING PATH...");

    fetch(
      `http://localhost/api/route?source=${source}&destination=${destination}`
    )
      .then((res) => res.json())
      .then(
        (result) => {
          this.setState({
            route: result.flat(),
          });

          if (result.flat().length === 0) {
            console.log("test");
            this.setState({
              force: "not-found",
            });
          }
        },
        (error) => {
          this.setState({
            error,
          });
        }
      );
  };

  render() {
    const { route, source, destination, force } = this.state;
    return (
      <div className="bg-gray-300 container md:mx-auto flex flex-wrap">
        <h1 className="p-6 container text-center text-3xl text-bold">
          Projekt grupowy
        </h1>
        <Slider />
        <div className="container my-6 flex">
          <MapWrapper route={route} />
          <Form parentCallback={this.handleCallback} />
        </div>
        <Result
          source={source}
          destination={destination}
          route={route}
          force={force}
        />
        <Footer />
      </div>
    );
  }
}

export default App;
