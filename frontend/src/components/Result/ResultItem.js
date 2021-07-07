import React, { Component } from "react";

class ResultItem extends Component {
  getCases() {
    let cases = <></>;

    if (this.props.cases) {
      cases = (
        <>
          <p className="text-red-700">Zakażenia łączne: {this.props.cases}</p>
          <p className="text-red-700">
            Zakażenia aktywne: {this.props.cases.active}
          </p>
        </>
      );
    }

    return cases;
  }

  render() {
    const { index, name, population } = this.props;
    return (
      <div className="p-6 bg-white rounded-xl shadow-md flex items-center space-x-4 mr-4">
        <div>
          <div className="text-xl font-black font-medium text-black">
            {index + 1}. {name}
          </div>
          <p className="text-gray-700">Populacja: {population}</p>
          {this.getCases()}
        </div>
      </div>
    );
  }
}

ResultItem.defaultProps = {
  cases: null,
};

export default ResultItem;
