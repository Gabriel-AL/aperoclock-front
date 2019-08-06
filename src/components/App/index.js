// == Import : npm
import React from 'react';
import { Layout } from 'antd';
import { Route } from 'react-router-dom';

// == Import : local
import Nav from 'src/components/Nav';
import Header from 'src/components/Header';
import Footer from 'src/components/Footer';
import Dashboard from 'src/containers/Dashboard';
import LoginForm from 'src/containers/LoginForm';
import Home from 'src/components/Home';
import SignIn from 'src/components/SignIn';
import GroupForm from 'src/components/GroupForm';
import EventForm from 'src/components/EventForm';
import Events from 'src/components/Events';
import Groups from 'src/components/Groups';
import SimpleMap from 'src/components/Map';
import Profile from 'src/components/Profile';
import Contact from 'src/components/Contact';
import AlertColor from 'src/components/Alert';
import PrivateRoute from './PrivateRoute';
import './app.scss';

import data from 'src/data/index';

// == Composant
const App = () => {
  const {
    Header: AntdHeader,
    Footer: AntdFooter,
    Sider,
    Content,
  } = Layout;

  const isLogged = true;

  return (
    <>
      { isLogged
        ? (
          // if logged
          <div id="app">
            <Layout>
              <Sider>
                <Nav />
              </Sider>
              <Layout>
                <AntdHeader>
                  <Header />
                </AntdHeader>
                <Content>
                  <Route path="/" exact component={Dashboard} />
                  <Route path="/map" exact component={SimpleMap} />
                  <Route path="/groupes" exact component={Groups} />
                  <Route path="/evenements" exact component={Events} />
                  <Route path="/profil" exact component={Profile} />
                  <Route path="/contact" exact component={Contact} />
                  <Route path="/login" component={LoginForm} />
                  <Route path="/inscription" component={SignIn} />
                </Content>
                <AntdFooter className="footer">
                  <Footer />
                </AntdFooter>
              </Layout>
            </Layout>
          </div>
        ) : (
          // if not logged
          <Layout>
            <Content>
              <Route path="/home" exact component={Home} />
            </Content>
          </Layout>
        )
      }

    </>
  );
};

// == Export
export default App;
