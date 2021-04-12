'use strict';

const e = React.createElement;

class Head extends React.Component {

    constructor(props) {
        super(props);
            this.state = { 
                name: 'default',
                isLoaded: false
            }
    }

    componentDidMount() {
        fetch('../Database/api/object_methods/person/getName.php')
            .then(res => res.json())
            .then(data => {
                this.setState({
                    name: data,
                    isLoaded: true
                })
                console.log(data);
            });
    }
    
    render() {
        return e("div", null, e("h1", {
          className: "doctor_text"
        }, "", this.state.name), e("div", {
          className: "profile_image"
        }));
    }

}

const domContainer2 = document.querySelector('#doctor_page');
ReactDOM.render(e(Head), domContainer2);