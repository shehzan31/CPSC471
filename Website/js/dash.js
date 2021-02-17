'use strict';

const e = React.createElement;

class Dash extends React.Component {
    render() {
        return e("h1",null, "Dashboard")
    }
}

const domContainer = document.querySelector('#dashboard');
ReactDOM.render(e(Dash), domContainer);