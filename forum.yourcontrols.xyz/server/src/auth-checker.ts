import { AuthChecker } from 'type-graphql';
import { Context } from './context';

/**
 * Custom auth checker
 * @param param0 - GraphQL request
 * @param roles - Args to @Authorization(...args:any[])
 */
export const customAuthChecker: AuthChecker<Context> = (
    { root, args, context, info },
    roles
) => {
    if (roles.length === 0) {
        return context.user !== undefined;
    }
    if (!context.user) {
        return false;
    }
    if (context.user.roles.some(r => roles.includes(r.roleName))) {
        return true;
    }
    return false;
};
