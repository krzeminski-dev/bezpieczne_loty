import React, {Component} from 'react';
import ResultItem from './ResultItem';

class Result extends Component
{
    hasRoute = () => {
        return this.props.source && this.props.destination;
    }

    resultTitle = () => {
        return this.hasRoute()
            ? <>
                Najkorzystniejsza trasa z
                <div className='font-black'> { this.props.source.label } </div>
                do 
                <div className='font-black'> { this.props.destination.label } </div>
            </>
            : <>Wybierz dwa państwa aby obliczyć najkorzystniejszą trasę</>;
    }

    resultItemsHeader = (text) => {
        return <div className="p-6 bg-white justify-center rounded-xl shadow-md flex items-center space-x-4 mr-4 w-full">
            <div>
                <div className="text-xl font-black font-medium text-black">{text}</div>
            </div>
        </div>;
    }

    resultItems = () => {
        if (this.props.route.length > 0) {
            return this.props.route.map((country, index) => (
                    <ResultItem
                        id={country.id}
                        name={country.name}
                        population={country.population}
                        cases={country.cases}
                        key={index}
                        index={index}
                    />
                ));
        } else if (this.props.force === 'calculate') {
            return this.resultItemsHeader('Obliczanie trasy...');
        } else if (this.props.force === 'not-found') {
            return this.resultItemsHeader('Nie znaleziono trasy.')
        }
    }

    render() {
        return (
            <div className="container bg-gray-400 p-6">
                <div className="flex justify-center whitespace-pre-wrap">
                    {this.resultTitle()}
                </div>
                <div className="flex flex-row mt-4">
                    {this.resultItems()}
                </div>
            </div>
        );
    }
}

Result.defaultProps = {
    source: null,
    destination: null,
    route: [],
    force: 'empty',
}

export default Result;

