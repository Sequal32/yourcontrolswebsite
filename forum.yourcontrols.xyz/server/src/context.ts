import { User } from './entities';

/**
 * GraphQL server context type
 */
export interface Context {
    user?: User;
}
