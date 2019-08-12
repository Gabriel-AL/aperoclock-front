// == Types
import globalConstants from 'src/constants/globalConstants';

// == Initial State
const initialState = {
  actualGroup: null,
  actualEvent: null,
  baseTitle: 'AperO\'Clock',
  title: '',
};


// == Reducer
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case globalConstants.CHANGE_ACTUAL_EVENT:
      return {
        ...state,
        actualEvent: action.newActualvent,
      };
    case globalConstants.CHANGE_ACTUAL_GROUP:
      return {
        ...state,
        actualGroup: action.newActualGroup,
      };
    case globalConstants.CHANGE_TITLE:
      return {
        ...state,
        title: action.newTitle,
      };

    default:
      return state;
  }
};


// == Export
export default reducer;
