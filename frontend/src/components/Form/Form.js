import React from "react";
import Select from 'react-select'

class Form extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            isDisabled: true,
            source: null,
            destination: null,
            countries: []
        }
    }

    componentDidMount() {
        fetch("http://localhost/api/countries")
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        isLoaded: true,
                        countries: result.map( country => ({
                            value: country.id,
                            label: country.name
                        }))
                    });
                },
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    }

    findCountry = (selectedOption) => {
        const source = this.state.countries.filter((country) => {
            return country.value === selectedOption.value;
        }, selectedOption);

        return source[0];
    }

    handleSourceChange = selectedOption => {
        this.setState({source: this.findCountry(selectedOption)})
    };

    handleDestinationChange = selectedOption => {
        this.setState({destination: this.findCountry(selectedOption)})
    };

    // Send data to parent App component
    onTrigger = (event) => {
        this.props.parentCallback({
            source: this.state.source,
            destination: this.state.destination,
        });
        event.preventDefault();
    }

    render() {

        const isLoaded = this.state.isLoaded;

        let content;

        if (isLoaded) {
            content =
            <div>
                <label className="block mb-3">Miejsce wylotu</label>
                <Select
                    options={this.state.countries}
                    onChange={this.handleSourceChange}
                />

                <label className="block mb-3 mt-2">Cel trasy</label>
                <Select
                    options={this.state.countries}
                    onChange={this.handleDestinationChange}
                />
            </div>;
        } else {
            content = <div>Ładowanie krajów...</div>;
        }

        return (

            <div className="mr-6 form-wrap flex-1 p-6 bg-gray-200 rounded shadow-sm self-center">
                <p className="text-center bg-white -m-6 mb-6 p-6 font-bold rounded rounded-b-none border-b border-gray-400">Podaj
                    informacje</p>
                <form onSubmit={this.onTrigger}>
                {content}
                <button
                    className={`bg-blue-800 border-blue-900 hover:bg-blue-700 hover:border-blue-800 self-end focus:border-b-2 mt-3 container duration-300 text-white font-bold py-2 px-4 border-b-4 rounded`}
                    type="submit">Szukaj trasy
                </button>
                </form>
            </div>
        )
    }
}

export default Form;