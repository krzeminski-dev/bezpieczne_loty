import React, {Component} from 'react';

class ResultItem extends Component
{
    getCases() {
        let cases = <></>;

        if (this.props.cases) {
            cases = <>
                <p className="text-red-700">Zakażenia łączne: {this.props.cases.cases}</p>
                <p className="text-red-700">Zakażenia aktywne: {this.props.cases.active}</p>
            </>
        }

        return cases;
    }

    render() {
        return (
            <div className="p-6 bg-white rounded-xl shadow-md flex items-center space-x-4 mr-4">
                <div>
                    <div className="text-xl font-black font-medium text-black">{this.props.index + 1}. {this.props.name}</div>
                    <p className="text-gray-700">Populacja: {this.props.population}</p>
                    {this.getCases()}
                </div>
            </div>
        );
    }
}

ResultItem.defaultProps = {
    cases: null,
}

export default ResultItem;