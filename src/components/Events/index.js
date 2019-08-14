// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import {
  Card,
  Button,
  Modal,
  Input,
} from 'antd';

// == Import : local
import SelectSpecialEvent from 'src/containers/SelectSpecialEvent';


// == Composant
class Events extends React.Component {
  state = { visible: false };

  componentDidMount() {
    const { dispatchNewTitle } = this.props;
    dispatchNewTitle('Mes Événements');
  }

  showModal = () => {
    this.setState({
      visible: true,
    });
  };

  handleOk = (e) => {
    console.log(e);
    this.setState({
      visible: false,
    });
  };

  handleCancel = (e) => {
    console.log(e);
    this.setState({
      visible: false,
    });
  };

  render() {
    const { actualEvent, events } = this.props;

    const actualEventFull = events.find(event => (event.id === actualEvent));

    const { TextArea } = Input;

    return (
      <div id="events">
        <SelectSpecialEvent />
        {
          actualEvent !== null && (
            <Card title={actualEventFull.name}>
              <p>{actualEventFull.description}</p>
            </Card>
          )
        }
        <Button type="primary" onClick={this.showModal}>
          Créer un événement
        </Button>
        <Modal
          title="Création d'un événement"
          visible={this.state.visible}
          onOk={this.handleOk}
          onCancel={this.handleCancel}
        >
          <Input placeholder="Nom de l'événement" />
          <TextArea placeholder="Description de l'événement" rows={4} />
        </Modal>
      </div>
    );
  }
}

Events.propTypes = {
  actualEvent: PropTypes.number,
  events: PropTypes.array,
  dispatchNewTitle: PropTypes.func.isRequired,
};

Events.defaultProps = {
  actualEvent: null,
  events: [],
};

// == Export
export default Events;
